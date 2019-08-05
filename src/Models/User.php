<?php

namespace Backers\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}