<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_id',
        'sku_id',
        'url',
        'is_cover',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function sku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}