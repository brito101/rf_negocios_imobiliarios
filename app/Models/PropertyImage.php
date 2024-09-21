<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order', 'name', 'location', 'property_id',
    ];

    /** Relationships */
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
