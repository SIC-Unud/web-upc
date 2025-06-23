<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Excel as ExcelFormat;

class ParticipantExportController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(
            new ParticipantExport($request->competition_id, $request->status),
            'participants.csv',
            ExcelFormat::CSV
        );
    }
}
