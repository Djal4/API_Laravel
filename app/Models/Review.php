<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[
        'mark',
        'pros',
        'cons',
        'intern_id',
        'mentor_id',
        'assignement_id'
    ];
    public $timestamps=false;
}
