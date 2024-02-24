<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CsvImportController extends Controller
{
    public function showPrefecture() {
        return view();
    }

    public function importPrefecture() {
        return view();
    }

    public function showRegion() {
        return view('/import-csv-region');
    }

    public function importRegion(Request $request) {
        $file = $request->file('file');
        dd($request, $file);
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        
        foreach ($sheetData as $row) {
            echo implode(', ', $row) . "<br>";
        }
        
        // return view();
    }
}
