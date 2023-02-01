<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrigenLlamada extends Model
{
    use HasFactory;

    protected $fillable = [
        'origen_llamada',
    ];

    public function gestiones()
    {
        return $this->hasMany(Gestion::class);
    }
}
