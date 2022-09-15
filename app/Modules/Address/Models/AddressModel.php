<?php

namespace App\Modules\Address\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    use HasFactory;

    protected $table = 'address';

    protected $fillable = [
        'address',
        'post_code',
        'city_name',
        'country_name',
        'person_slug',
        'is_active'
    ];

    public function fillFields()
    {
        return [
            'address' => null,
            'post_code' => null,
            'city_name' => null,
            'country_name' => null,
            'person_slug' => null,
            'is_active' => 1
        ];
    }

    protected $guarded = [
        'person_slug'
    ];


    public function scopeIsDeleted($q)
    {
        return $q->where('is_deleted', 0);
    }

    public function scopeIsActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function scopeRequirement($q)
    {
        return $q->with('person');
    }

    public function person()
    {
        return $this->hasOne('App\Modules\Person\Models\PersonModel', 'slug', 'person_slug');
    }
}
