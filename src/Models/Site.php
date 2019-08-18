<?php

namespace Backers\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';
    protected $primaryKey = 'id';

    protected $fillable = [
        'url',
        'text'
    ];
}