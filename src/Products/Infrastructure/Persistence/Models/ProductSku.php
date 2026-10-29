<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $table = 'product_skus';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'product_id' => 'string',
        'sku_code' => 'string',
        'ean' => 'string',
        'price' => 'float',
        'stock' => 'int',
    ];

    protected $fillable = [
        'id',
        'product_id',
        'sku_code',
        'ean',
        'price',
        'stock',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}