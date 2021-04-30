<?php
namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\Ads;

// TO DO : make it work

class GetLastAds {
    public function show()
    {
        return Ads::orderBy('created_at', 'desc')->paginate(8);
    }
}