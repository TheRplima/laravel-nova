<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttractionWay extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_forma_capitacao';
    protected $primaryKey = 'id_forma_capitacao';

    public function campanhas()
    {
        return $this->belongsToMany(Campaign::class, 'cad_forma_capitacao_campanha', 'id_forma_capitacao', 'id_campanha')
            ->withPivot('hash');
    }
}
