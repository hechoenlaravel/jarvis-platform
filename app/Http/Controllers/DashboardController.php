<?php

namespace JarvisPlatform\Http\Controllers;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('index');
    }

}