<?php

namespace App\Http\Controllers;

use App\Http\Requests\Awb\AwbStoreRequest;
use Illuminate\Http\Request;

class AwbController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

    }

    public function create()
    {
        return view('layouts.dashboard.awb.create');
    }

    public function store(AwbStoreRequest $request)
    {


    }

}
