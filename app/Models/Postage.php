<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postage extends Model
{
    protected $table = 'postages';

    protected $fillable = [
        'code',
        'service',
        'ongkir_total_amount',
    ];
}
