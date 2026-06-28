<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];


}
