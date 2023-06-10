<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;
use SheetDB\SheetDB;
use Faker\Factory as Faker;

class SheetController extends Controller
{
    protected $sheetdb;


    public function __construct()
    {
        // $sheetdb = new SheetDB('iawu6fuo2bxng');
        /**
         * Creating object of SheetDB and passing API key to it.
         * To generate API key to got sheetdb.io and generate a new key using google sheet URL.
         * 
         */
        $this->sheetdb = new SheetDB('2zk8uiy2yhz4l');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sheets = Sheet::all();
        return view('sheet.index', compact('sheets'));
    }
    /**
     * Sync data with google sheet
     */

    public function sync()
    {



        /**
         * Recieving and storing data to variable
         */
        $data =  $this->sheetdb->get();

        /**
         * Looping througn the $data 
         */
        foreach ($data as $value) {
            /**
             *  Converting $value from an 'stdObject' to 'Associative Array' to access data using keys
             */
            $v = (array)$value;
            /**
             * Saving data to Database 
             */
            $sheet = new Sheet();
            $sheet->first_name = $v['First Name'];
            $sheet->last_name = $v['Last Name'];
            $sheet->phone = $v['Phone'];
            $sheet->email = $v['Email'];
            $sheet->company_name = $v['Company Name'];
            $sheet->owner = $v['Owner'];
            $sheet->employees = $v['Employees'];
            $success = $sheet->save();
        }
        /**
         * If data is successfully saved then delete all rows from google sheet
         */
        if ($success) {
            foreach ($data as $value) {
                $v = (array)$value;
                $this->sheetdb->delete('First Name', $v['First Name']);
            }
        } else {
            return "Data no saved";
        }
        return redirect(route('sheet.index'));

        //return "DATA SAVED";
    }

    /**
     * Insert fake data for testing purpose
     */

    public function insert()
    {
        $faker = Faker::create();

        $this->sheetdb->create([
            [
                'Date' => date('m/d/Y h:i:s a', time()),
                'First Name' => $faker->firstName(),
                'Last Name' => $faker->lastName,
                'Phone' => $faker->phoneNumber(),
                'Email' => $faker->email(),
                'Company Name' => $faker->word(),
                'Owner' => (rand(1, 0)) ? 'Yes' : 'No',
                'Employees' => '3-6'
            ],
        ]);
        return redirect(route('sheet.index'));
    }

    /**
     * Delete Data from sheet
     */

    public function delete_from_sheet()
    {
        $this->sheetdb->delete('First Name', 'Chris');
        return redirect(route('sheet.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sheet $sheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sheet $sheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sheet $sheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sheet $sheet)
    {
        //
    }
}
