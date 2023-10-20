<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'nota';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo_nota', 'contenido_nota', 'carpeta'];

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class);
    }
}
