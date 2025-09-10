<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
class Customer extends Model
{
    protected $primaryKey = 'id_customer';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_customer','nom','prenom','adresse','telephone',
        'email','is_verified_mail','activite','image','etat'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->id_customer)) {
                do {
                    $code = 'CUST-' . rand(1000, 9999) . '-' . rand(1000, 9999);
                } while (self::where('id_customer', $code)->exists());

                $customer->id_customer = $code;
            }
        });
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'id_customer', 'id_customer');
    }
}
