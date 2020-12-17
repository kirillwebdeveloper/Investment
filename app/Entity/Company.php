<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'city',
        'address',
        'postcode',
        'registration_date'
    ];

    public function investment()
    {
        return $this->hasMany('App\Entity\Investment');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function(self $company) {
            $company->investment()->delete();
        });
    }
}
