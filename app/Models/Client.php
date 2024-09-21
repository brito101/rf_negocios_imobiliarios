<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'document_person', 'document_registry',
        'email', 'telephone', 'cell', 'zipcode', 'street', 'number', 'complement',
        'neighborhood', 'state', 'city', 'company', 'observations', 'step_id',  'agency_id', 'user_id', 'meeting',
        'property_interest', 'contact_message', 'instagram',
    ];

    /** Relationships */
    public function agency()
    {
        return $this->belongsTo(Agency::class)->withDefault([
            'alias_name' => 'Inexistente',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    public function step()
    {
        return $this->belongsTo(Step::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    /** Aux */
    public function getAddress()
    {
        return ($this->street ? $this->street.', ' : '').($this->number ? 'nº '.$this->number.'. ' : '').($this->neighborhood ? 'Bairro: '.$this->neighborhood : '').'. '.$this->city.'-'.$this->state.'. CEP: '.$this->zipcode.'. '.($this->complement ?? $this->complement);
    }
}
