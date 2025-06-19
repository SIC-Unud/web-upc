<?php

namespace App\Http\Controllers;


class PdfController extends Controller
{
    public function invoice($no_registration) {
        return generateInvoice($no_registration);
    }
}
