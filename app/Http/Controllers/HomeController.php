<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display dashboard.
     *
     * @return Response
     */
    public function index() {
        return view('home.index');
    }

    /**
     * SMS Marketing dashboard.
     *
     * @return Response
     */
    public function marketing() {
        return view('home.marketing');
    }

}
