<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWayCampaign extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_forma_contato_campanha';
    protected $primaryKey = 'id_forma_contato_campanha';

    public function campanhas() {
        return $this->hasMany(Campaign::class, 'id_forma_contato_campanha', 'id_forma_contato_campanha');
    }
}
