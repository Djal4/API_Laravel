<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable=[
        'name',
        'lastname',
        'city',
        'email',
        'number',
        'group_id',
        'cv'
    ];
}
