<?php

namespace Backers\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'created_at',
        'car_model',
        'car_Color',
        'doc_id',
        'doc_type',
        'company_category',
        'phone_prefix'
    ];
}