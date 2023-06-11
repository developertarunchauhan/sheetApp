<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use Faker\Factory as Faker;
use Revolution\Google\Sheets\Facades\Sheets;

class GooglesheetController extends Controller
{

    protected $googlesheet;

    public function __construct()
    {
        /**
         * Initialize sheet
         */
        $this->googlesheet = Sheets::spreadsheet('1n2r0bYLL1_qUTYpCT9bQs7AB8bRfXIN8P4zaxUskqbs')->sheet('data_one');
    }

    public function index()
    {
        $sheets = Sheet::all();
        return view('googlesheet.index', compact('sheets'));
    }

    public function sync()
    {
        /**
         * Getting all data from Googlesheet
         */
        $sheet = $this->googlesheet->get();
        $header = $sheet->pull(0); // pulls out the column names/table headers from first row
        $values = Sheets::collection($header, $sheet);
        foreach ($values as $value) {
            $exists = Sheet::where('email', '=', $value['Email'])->exists();
            if (!$exists) {
                $sheet = new Sheet();
                $sheet->first_name = $value['First Name'];
                $sheet->last_name = $value['Last Name'];
                $sheet->phone = $value['Phone'];
                $sheet->email = $value['Email'];
                $sheet->company_name = $value['Company Name'];
                $sheet->owner = $value['Owner'];
                $sheet->employees = $value['Employees'];
                $sheet->save();
            }
        }
        return redirect(route('googlesheet.index'));
    }
    public function insert()
    {
        $faker = Faker::create();
        $list = [];
        for ($i = 0; $i < 5; $i++) {
            $list[] = [
                'Date' => date('m/d/Y h:i:s a', time()),
                'First Name' => $faker->firstName(),
                'Last Name' => $faker->lastName,
                'Phone' => '8091334020',
                'Email' => $faker->email(),
                'Company Name' => $faker->word(),
                'Owner' => 'Yes',
                'Employees' => '3-6',
                'Imported' => 'No',
            ];
        }
        $this->googlesheet->append($list);
        return redirect(route('googlesheet.index'));
    }
}
