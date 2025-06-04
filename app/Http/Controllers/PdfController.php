<?php

namespace App\Http\Controllers;


class PdfController extends Controller
{
    public function index($no_registration) {
        return generateInvoice($no_registration);
    }
}
