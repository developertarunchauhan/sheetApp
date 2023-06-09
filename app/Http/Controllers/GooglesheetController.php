<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sheets;

class GooglesheetController extends Controller
{
    public function get()
    {


        /**
         * Append Values to Sheet
         */
        //Sheets::spreadsheet('1n2r0bYLL1_qUTYpCT9bQs7AB8bRfXIN8P4zaxUskqbs')->sheet('data_one')->append([['Name' => 'Vikas Kumar', 'Age' => '29', 'Job' => 'HR', 'Location' => 'Shimla']]);

        /**
         * Getting Data From Sheet
         */
        $rows = Sheets::spreadsheet('1n2r0bYLL1_qUTYpCT9bQs7AB8bRfXIN8P4zaxUskqbs')->sheet('data_one')->get();

        $values = Sheets::all();
        $header = $rows->pull(0);
        $values = Sheets::collection(header: $header, rows: $rows);
        return $values->toArray();
    }
}
