<?php

namespace App\Modules\Person\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonModel extends Model
{
    use HasFactory;

    protected $table = 'person';

    protected $fillable = [
        'name',
        'birthday',
        'gender',
        'is_active',
        'created_at'
    ];

    public function fillFields()
    {
        return [
            'name' => null,
            'birthday' => null,
            'gender' => null,
            'is_active' => 1,
            'is_deleted' => 0,
            'created_at' => now()
        ];
    }

    protected $guarded = [];


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
        return $q->with('address');
    }

    public function address()
    {
        return $this->hasOne('App\Modules\Address\Models\AddressModel', 'person_slug', 'slug');
    }
}
