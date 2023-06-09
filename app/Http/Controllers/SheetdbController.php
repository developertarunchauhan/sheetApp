<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;

class SheetdbController extends Controller
{
    public function get()
    {
        $sheetdb = new SheetDB('2zk8uiy2yhz4l', 'data_one');

        $data =  $sheetdb->get();

        dd($data);
    }
}
