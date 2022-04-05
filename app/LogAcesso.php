<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    /* indica que a coluna 'log' desta tabela pode ser preenchido de modo massivo */
    protected $fillable = ['log'];
}
