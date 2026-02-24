<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceSheet extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'finance_sheets';

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
    protected $guarded = [];

    public function grossIncome(){
        return $this->hasMany(FinanceGrossIncome::class, 'finance_sheet_id','id');
    }
    public function grossCogs(){
        return $this->hasMany(FinanceCog::class, 'finance_sheet_id','id');
    }
    public function grossExpense(){
        return $this->hasMany(FinanceGrossExpense::class, 'finance_sheet_id', 'id');
    }
    public function totalOhExpense(){
        return $this->hasMany(FinanceOhExpense::class, 'finance_sheet_id', 'id');
    }

}
