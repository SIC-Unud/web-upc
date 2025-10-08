<?php

namespace App\Http\Controllers;

use App\Exports\AttemptExport;
use App\Models\Competition;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

class AttemptExportController extends Controller
{
    public function export(Competition $competition)
    {
        $slug = $competition->slug;
        return Excel::download(
            new AttemptExport($competition->id, $competition->is_simulation),
            "$slug-export.csv",
            ExcelFormat::CSV
        );
    }
}
