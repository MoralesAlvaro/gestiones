<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLlamada extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_llamada',
    ];

    public function gestiones()
    {
        return $this->hasMany(Gestion::class);
    }
}
