<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    protected $table = 'carpeta';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre_carpeta', 'color_carpeta', 'usuario'];

    public function notas() {
        return $this->hasMany(Nota::class, 'carpeta');
    }
}
