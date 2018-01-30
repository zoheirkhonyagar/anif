<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\GlobalController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminController extends GlobalController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
