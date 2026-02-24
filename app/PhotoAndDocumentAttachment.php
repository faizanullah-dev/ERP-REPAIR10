<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoAndDocumentAttachment extends Model
{
    use SoftDeletes;
    protected $table = 'photo_and_document_attachments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getPhoto(){
        return $this->belongsTo(PhotoAndDocument::class, 'document_id',);
    }

}
