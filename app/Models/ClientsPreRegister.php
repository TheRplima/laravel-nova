<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsPreRegister extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_pre_cadastro_cliente_campanha';
    protected $primaryKey = 'id_pre_cadastro_cliente_campanha';

    public function campanhas()
    {
        return $this->belongsToMany(Campaign::class, 'cad_forma_capitacao_campanha', 'hash', 'hash');
    }
}
