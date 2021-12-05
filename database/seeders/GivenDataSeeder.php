<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class GivenDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::create([
            'name' => 'Mas Anton',
            'address' => 'Jalan Bunga no 24, Jakarta Barat'
        ]);

        $item = Item::create([
            'id' => 1212,
            'name' => 'Cangkir Gurame',
            'price' => 200000
        ]);

        $invoice = Invoice::create([
            'id' => 73456,
            'item_id' => $item->id,
            'customer_id' => $customer->id,
            'qty' => 12,
            'subtotal' => 240000
        ]);

        Payment::create([
            'invoice_id' => $invoice->id,
            'payment_method' => 'transfer',
            'status' => 'paid',
            'paid_at' => '2020-11-12'
        ]);
    }
}
