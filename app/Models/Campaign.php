<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_campanha';
    protected $primaryKey = 'id_campanha';

    public function forma_contato() {
        return $this->belongsTo(ContactWayCampaign::class, 'id_forma_contato_campanha');
    }

    public function formas_capitacao()
    {
        return $this->belongsToMany(AttractionWay::class, 'cad_forma_capitacao_campanha', 'id_forma_capitacao', 'id_campanha')
            ->withPivot(['hash']);
    }
}
