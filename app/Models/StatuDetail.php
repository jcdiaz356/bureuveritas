<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatuDetail extends Model
{
    use HasFactory;

    protected $table= 'status_details';
    protected $fillable=[
        'service_id',
        'statu_id',
        'user_id',
        'date_register'
    ];


}
