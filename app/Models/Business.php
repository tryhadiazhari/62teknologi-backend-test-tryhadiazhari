<?php

namespace App\Models;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory, UuidGenerator;

    protected $table = 'business';
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function location()
    {
        return $this->hasOne(BusinessLocation::class, 'business_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(BusinessCategories::class, 'business_id', 'id');
    }
}
