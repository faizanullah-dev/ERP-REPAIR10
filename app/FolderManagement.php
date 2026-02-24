<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderManagement extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folder_managements';

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

    public function files(){
        return $this->hasMany(FolderManagementAttachment::class, 'folder_management_id');
    }
    public function getLead(){
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

}
