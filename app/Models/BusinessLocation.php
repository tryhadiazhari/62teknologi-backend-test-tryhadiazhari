<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLocation extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'business_location';
    public $timestamps = true;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];
}
