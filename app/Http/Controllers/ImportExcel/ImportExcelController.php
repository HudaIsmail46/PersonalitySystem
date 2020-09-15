<?php

namespace App\Http\Controllers\ImportExcel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ImportBookings;
use Maatwebsite\Excel\Facades\Excel;
use App\Booking;

class ImportExcelController extends Controller

{

    public function index(Request $request)
    {

        $bookings = Booking::orderBy('id','ASC')->paginate(20);
        $value = ($request->input('page', 1) - 1) * 5; 
        return view('import-excel.index',compact('bookings'))
        ->with('i', $value);

    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new ImportBookings, request()->file('import_file'));
        return back()->with('success', 'Bookings imported successfully.');
    }
}
