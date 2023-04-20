<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_cliente';
    protected $primaryKey = 'id_cliente';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    public function proposals() {
        return $this->hasMany('App\Models\Proposal');
    }
}
