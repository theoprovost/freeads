<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'ads_id',
        'url'
    ];

    public function ads()
    {
        return $this->belongsTo(Ads::class);
    }
}