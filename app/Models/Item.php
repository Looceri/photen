<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'nome',
        'imagem',
        'tipo_de_documento',
        'descricao',
        'local_de_encontrado',
        'registador',
        'status', // Add the 'tatus' attribute to the fillable array
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->status = true; // Set the default value for the 'tatus' attribute
    }

}
