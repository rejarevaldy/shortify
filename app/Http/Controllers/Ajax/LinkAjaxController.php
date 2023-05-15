<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkAjaxController extends Controller
{
    public function getAll()
    {
        $links = Link::all();

        return response()->json($links);
    }
}
