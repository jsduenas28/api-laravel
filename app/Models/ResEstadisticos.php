<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResEstadisticos extends Model
{
    protected $table = 'res_estadisticos';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo_nota', 'resultados', 'nota_cuestionario', 'usuario'];

    public function getResultadosAttribute($value)
    {
        return json_decode($value, true);
    }

    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }
}


