<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendant extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlGacAgil';
    protected $table = 'cad_usuario';
    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'date_create';

    public function proposals() {
        return $this->hasMany('App\Models\Proposal','id_usuario');
    }
}
