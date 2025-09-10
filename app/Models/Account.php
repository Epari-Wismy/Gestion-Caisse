<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'id_account';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_account','id_customer','montant_plan','nb_jours',
        'solde','nb_jours_rester','etat'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            if (empty($account->id_account)) {
                do {
                    $code = 'ACC-' . rand(1000, 9999) . '-' . rand(1000, 9999);
                } while (self::where('id_account', $code)->exists());

                $account->id_account = $code;
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}
