<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use App\Models\Region;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CsvImportController extends Controller
{
    public function showPrefecture()
    {
        return view('/import-csv-prefecture');
    }

    public function importPrefecture(Request $request)
    {
        $file = $request->file('file');
        $data = file_get_contents($file);
        $json = json_decode($data, true);

        // dd($json['prefecture']);

        foreach ($json['prefecture'] as $prefectureValue) {
            // dd($prefectureValue['name'], $prefectureValue['region_id']);
            $prefecture = new Prefecture();
            $prefecture->name = $prefectureValue['name'];
            $prefecture->region_id = $prefectureValue['region_id'];

            $prefecture->save();
        }

        session()->flash('message', 'jsonを保存しました');

        return view('import-csv-region');
    }

    public function showRegion()
    {
        return view('/import-csv-region');
    }

    // public function importRegionCsv(Request $request) {
    //     $file = $request->file('file');
    //     $spreadsheet = IOFactory::load($file->getPathName());
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();


    //     foreach ($sheetData as $row) {
    //         echo implode(', ', $row) . "<br>";
    //     }

    //     // return view();
    // }

    public function importRegion(Request $request)
    {
        $file = $request->file('file');
        $data = file_get_contents($file);
        $json = json_decode($data, true);

        // dd($json['region']);

        foreach ($json['region'] as $regionValue) {
            // dd($region);
            // echo($region['name']);

            $region = new Region();
            $region->name = $regionValue['name'];

            $region->save();
        }

        session()->flash('message', 'regionを保存しました');

        return view('import-csv-region');
    }
}
