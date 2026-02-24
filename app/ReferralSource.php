<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralSource extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'referral_sources';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','status'];

    public function monthlyAdvertisement()
    {
        return $this->hasMany(MonthlyAdvertisement::class, 'referral_source_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'referral_source_id');
    }

}
