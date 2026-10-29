<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
}