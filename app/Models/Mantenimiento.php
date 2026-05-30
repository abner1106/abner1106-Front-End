<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';
    protected $primaryKey = 'id_mantenimiento';
    protected $fillable = [
        'id_equipo',
        'tipo_mantenimiento',
        'descripcion_falla',
        'acciones_realizadas',
        'fecha_mantenimiento'
    ];

    protected $casts = [
        'fecha_mantenimiento' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }
}