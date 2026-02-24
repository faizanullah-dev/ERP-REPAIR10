<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignDetail extends Model
{
    use SoftDeletes;
    protected $table = 'campaign_details';
    protected $primaryKey = 'id';
        protected $guarded = [];

    protected $restrictedPatterns = [
        '/<\?php.*\?>/',                // PHP code injection
        '/<script.*>.*<\/script>/',     // JavaScript injection
        '/eval\(/',                     // eval() function
        '/base64_encode\(/',            // Base64 encoded code
        '/system\($_GET\[.*\]\)/',      // Command injection
        '/<iframe.*>.*<\/iframe>/',     // iframe injection
        '/onerror=.*>/i',               // onerror event handler
        '/alert\(/',                    // JavaScript alert()
        '/<meta.*http-equiv.*refresh.*content=.*>/i', // Meta refresh injection
        '/document\.location/',         // Document location change
        '/window\.location/',           // Window location change
        '/<.*on\w+=.*>/i',              // Inline event handlers (onerror, onclick, etc.)
    ];

    // Setter for the description attribute
    public function setDescriptionAttribute($value)
    {
        foreach ($this->restrictedPatterns as $pattern) {
            $value = preg_replace($pattern, '', $value);
        }
        $this->attributes['message'] = strip_tags(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class,'campaign_id');
    }//ends function getStages.
    public function emailTemplate(){
        return $this->belongsTo(EmailTemplate::class, 'email_template_id', 'id');
    }
    public function campaignAttachment(){
        return $this->hasMany(CampaignAttachment::class, 'campaign_detail_id', 'id');
    }
}
