<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttractionWayCampaign extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_forma_capitacao_campanha';
    protected $primaryKey = 'id_forma_capitacao_campanha';
}
