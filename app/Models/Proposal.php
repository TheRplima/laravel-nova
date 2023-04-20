<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_proposta';
    protected $primaryKey = 'id_proposta';

    const CREATED_AT = 'data_solicitacao_proposta';

    public function attendant() {
        return $this->belongsTo('App\Models\Attendant');
    }

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }
}
