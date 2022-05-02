<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TonnageDetail extends Model
{
    use HasFactory;

    protected $table = 'tonnages_details';
    protected $fillable =[
           'service_id',
           'tonnange',
           'date_register',
           'user_id',
    ];
}
