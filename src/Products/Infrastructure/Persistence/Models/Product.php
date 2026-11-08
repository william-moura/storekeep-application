<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class, 'product_id');
    }
}