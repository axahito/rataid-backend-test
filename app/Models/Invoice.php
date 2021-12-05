<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'customer_id', 'qty', 'subtotal'];

    /**
     * Get the production associated with the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function production()
    {
        return $this->hasOne(Production::class);
    }

    /**
     * Get the payment associated with the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the item that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the customer that owns the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Invoice::max('id') == 0) {
                $model->code = 'INV-'.str_pad($model->id, 5, '0', STR_PAD_LEFT);
            } else {
                $model->code = 'INV-'.str_pad(Invoice::max('id') + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
