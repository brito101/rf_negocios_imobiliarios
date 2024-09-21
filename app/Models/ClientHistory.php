<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id',
        'action',
        'step_id',
        'user_id',
        'agency_id',
    ];

    /** Relationships */
    public function client()
    {
        return $this->belongsTo(Client::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class)->withDefault([
            'alias_name' => 'Inexistente',
        ]);
    }

    public function step()
    {
        return $this->belongsTo(Step::class)->withDefault([
            'name' => 'Inexistente',
        ]);
    }

    /** Accessors */
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }
}
