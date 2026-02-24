<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roofestimatecalculatorpreferd extends Model
{
    use SoftDeletes;
    protected $table = 'roofestimatecalculatorpreferds';
    protected $primaryKey = 'id';
    protected $guarded = [];


}
