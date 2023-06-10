<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;

class SheetdbController extends Controller
{
    public function get()
    {
        $sheetdb = new SheetDB('iawu6fuo2bxng');

        $data =  $sheetdb->get();

        return $data;
    }
}
