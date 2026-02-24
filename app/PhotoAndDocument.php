<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoAndDocument extends Model
{
    use SoftDeletes;
    protected $table = 'photo_and_documents';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getDocuments(){
        return $this->hasMany(PhotoAndDocumentAttachment::class, 'document_id');
    }//ends function getDocuments.

    public function getlead(){
        return $this->belongsTo(Lead::class, 'lead_id');
    }//ends function getlead.

}
