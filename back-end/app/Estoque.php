<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['name', 'flag', 'tipe', 'quantidade', 'quantidade_min'];
}