<?php

namespace App\Models;

use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategories extends Model
{
    use HasFactory;

    protected $table = 'business_categories';

    public $timestamps = true;

    public $incrementing = true;

    protected $keyType = 'string';

    protected $guarded = ['id'];

    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }
}
