<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'social_name',
        'alias_name',
        'email',
        'phone',
        'document_company',
        'document_company_secondary',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
    ];

    protected $appends = [
        'address',
    ];

    /** Appends */
    public function getAddressAttribute()
    {
        return $this->street.($this->number ? ', nº '.$this->number : '').
            ($this->complement ? '. Complemento: '.$this->complement : '').
            ($this->neighborhood ? '. Bairro: '.$this->neighborhood : '').
            ($this->city ? '. '.$this->city : '').
            ($this->state ? '-'.$this->state : '').
            ($this->zipcode ? '. CEP: '.$this->zipcode : '');
    }

    /** Relationships */
    public function brokers()
    {
        return $this->hasMany(Broker::class);
    }

    /** Cascade actions */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($operation) {
            $operation->brokers()->delete();
        });
    }
}
