<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Invoice::max('id') == 0) {
                $model->code = 'GTX-'.str_pad($model->id, 4, '0', STR_PAD_LEFT);
            } else {
                $model->code = 'GTX-'.str_pad(Item::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
