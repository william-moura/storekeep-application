<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class SkuAttribute extends Model
{
    protected $table = 'sku_attributes';
    protected $primaryKey = 'sku_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'sku_id',
        'attribute_value_id',
    ];
    
    public function sku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}