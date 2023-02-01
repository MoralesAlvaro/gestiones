<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_llamada_id',
        'origen_llamada_id',
        'nombre',
        'telefono',
        'gestion',
    ];

    public function tipoLlamada() {
        return $this->belongsTo(TipoLlamada::class);
    }

    public function origenLlamada() {
        return $this->belongsTo(TipoLlamada::class);
    }
}
