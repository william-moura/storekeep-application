<?php

namespace Src\Products\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_values';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'attribute_id',
        'value',
    ];
    
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}