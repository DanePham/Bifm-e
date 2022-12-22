<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function index(Request $request)
    {
      return response()->json('successfully added');
    }
}
