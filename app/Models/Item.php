<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'tipo_de_documento',
        'descricao',
        'local_de_encontrado',
        'registador',
        'contacto',
    ];

}
