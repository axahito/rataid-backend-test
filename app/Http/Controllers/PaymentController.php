<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "SELECT payments.*, payments.id, i.code as invoice_code FROM payments 
                INNER JOIN invoices as i ON i.id=invoice_id";

        return response()->json([DB::select($query)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\PaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request, $invoice_id)
    {
        $query = "INSERT INTO payments (invoice_id, payment_method, `status`) VALUES
                (".$invoice_id.", '".$request->payment_method."', 'pending')";

        DB::insert($query);

        return response()->json(['message' => "Successfully added"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = "SELECT *, i.code FROM payments 
                INNER JOIN invoices as i ON i.id=invoice_id WHERE payments.id=".$id;
        $payment = DB::select($query);

        return response()->json([$payment], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\PaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        $payment = DB::select("SELECT `status` FROM payments WHERE id=".$id)[0];

        if (!empty($payment)) {
            if ($payment->status == 'pending') {
                $query = "INSERT INTO payments (payment_method, `status`) VALUES
                ('".$request->payment_method."', '".$request->status."')";
        
                DB::insert($query);
        
                return response()->json(['message' => "Successfully updated"], 200);
            } else {
                return response()->json(['message' => "You can't update this payment"], 403);
            }
        } else {
            return response()->json(['message' => 'Payment does not exist'], 404);
        }
    }

    public function upload(UploadRequest $request, $id)
    {
        $payment = DB::select("SELECT * FROM payments WHERE id=".$id." AND `status`='pending'");
        if (!empty($payment)) {
            $file = $request->file('file');
            $file->store('public/receipts');

            $name = $file->getClientOriginalName();
            $current_date = date('Y-m-d h:i:s');

            $query = "UPDATE payments SET receipt='".$name."', status='paid', paid_at='".$current_date."' WHERE id=".$id;
            DB::update($query);

            DB::insert("INSERT INTO productions (`invoice_id`, `status`, `notes`, `received_at`, `produced_at`)
                        VALUES (".$payment[0]->invoice_id.", 'designing', 'Payment received', '".$current_date."', '".$current_date."')");

            return response()->json(['message' => "Successfully uploaded"], 200);
        } else {
            return response()->json(['message' => 'Payment does not exist or it\'s already paid'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM payments WHERE id=".$id);

        return response()->json(['message' => 'Payment deleted'], 200);
    }
}
