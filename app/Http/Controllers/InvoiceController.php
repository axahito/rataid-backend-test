<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "SELECT invoices.*, invoices.id as id, i.code as item_code, i.name, i.price, c.name, c.address FROM invoices 
                INNER JOIN items as i ON i.id=item_id INNER JOIN customers as c ON c.id=customer_id";

        return response()->json([DB::select($query)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $item = DB::select("SELECT price FROM items WHERE id=".$request->item_id)[0];
      
        /*
            commented out because the DB::insert method does not trigger the model boot function
            which is responsible for creating code based on the id. So i used eloquent instead.

            $query = "INSERT INTO invoices (item_id, customer_id, qty, subtotal) VALUES
                    (".$request->item_id.", ".$request->customer_id.", ".$request->qty.", ".($item->price * $request->qty).")";

            DB::insert($query);
        */
        
        Invoice::create([
            'item_id' => $request->item_id,
            'customer_id' => $request->customer_id,
            'qty' => $request->qty,
            'subtotal' => ($item->price * $request->qty)
        ]);

        return response()->json(['message' => "Successfully added"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = "SELECT *, invoices.id as id, i.code, i.name, i.price, c.name, c.address FROM invoices 
                INNER JOIN items as i ON i.id=item_id INNER JOIN customers as c ON c.id=customer_id WHERE invoices.id=".$id;
        $invoice = DB::select($query);

        return response()->json([$invoice], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\InvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, $id)
    {
        if (!empty(Invoice::find($id)->payment->status) == 'paid') {
            return response()->json(['message' => "You can't update this invoice"], 403);
        }

        $item = DB::select("SELECT price FROM items WHERE id=".$request->item_id)[0];
        $query = "UPDATE invoices SET item_id=".$request->item_id.", customer_id=".$request->customer_id.
                ", qty=".$request->qty.", subtotal=".($item->price * $request->qty." WHERE id=".$id);

        DB::update($query);

        return response()->json(['message' => "Successfully updated"], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM invoices WHERE id=".$id);

        return response()->json(['message' => 'Invoice deleted'], 200);
    }
}
