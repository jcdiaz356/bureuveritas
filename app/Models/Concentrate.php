<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concentrate extends Model
{

    use HasFactory;
    protected $table = 'concentrates';
    protected $fillable= [
       'name',
       'created_at',
       'updated_at'
    ];
}
