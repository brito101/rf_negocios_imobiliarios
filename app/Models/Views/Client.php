<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients_view';

    protected $appends = [
        'created_at_pt',
    ];

    public function getCreatedAtPtAttribute()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }
}
