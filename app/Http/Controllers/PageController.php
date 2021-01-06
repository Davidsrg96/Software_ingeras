<?php

namespace App\Http\Controllers;

class PageController extends Controller
{

    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }
        return abort(404);
    }
}
