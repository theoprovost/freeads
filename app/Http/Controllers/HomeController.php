<?php
namespace App\Http\Controllers;

use App\Http\Controllers\API\AdsController;
use App\Http\Resources\AdsCollection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Retrieve last 8 ads posted
        $last_ads = new AdsCollection((new AdsController)->retrieveLastAds());
        return view('home', compact('last_ads'));
    }
}
