<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductionRequest;
use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "SELECT productions.*, productions.id, i.code as invoice_code FROM productions 
        INNER JOIN invoices as i ON i.id=invoice_id";

        return response()->json([DB::select($query)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ProductionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductionRequest $request, $invoice_id)
    {
        $payment = DB::select("SELECT `status` FROM payments WHERE invoice_id=".$invoice_id);
        
        if (!empty($payment)) {
            if ($payment[0]->status == 'paid') {
                $query = "INSERT INTO productions (invoice_id, `status`, notes, received_at, produced_at, finished_at) VALUES
                (".$invoice_id.", '".$request->status."', '".$request->notes."', '".$request->received_at."', '".$request->produced_at."', '".$request->finished_at."')";
        
                DB::insert($query);
        
                return response()->json(['message' => "Successfully added"], 200);
            } else {
                return response()->json(['message' => "The payment hasn't been confimed"], 403);
            }
        } else {
            return response()->json(['message' => "Order not found"], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = "SELECT productions.*, productions.id, i.code as invoice_code FROM productions 
                INNER JOIN invoices as i ON i.id=invoice_id WHERE productions.id=".$id;

        return response()->json([DB::select($query)], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $production = DB::select("SELECT `status` FROM payments WHERE id=".$id);
        
        if (!empty($production)) {
            $query = "UPDATE productions SET
                    `status`='".$request->status."', notes='".$request->notes."', received_at='".$request->received_at."', 
                    produced_at='".$request->produced_at."', finished_at='".$request->finished_at."'
                    WHERE id=".$id;
    
            DB::update($query);
    
            return response()->json(['message' => "Successfully updated"], 200);
        } else {
            return response()->json(['message' => "Order not found"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM productions WHERE id=".$id);

        return response()->json(['message' => 'Production deleted'], 200);
    }
}
