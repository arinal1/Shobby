<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'volume',
        'description',
        'publisher',
        'status',
        'image',
        'price'
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
