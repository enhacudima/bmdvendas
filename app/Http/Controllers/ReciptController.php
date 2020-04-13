<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReciptController extends Controller
{
    

    public function getPdf($type = 'stream')
{
    $pdf = app('dompdf.wrapper')->loadView('documentos.recipt', ['order' => $this]);

    if ($type == 'stream') {
        return $pdf->stream('invoice.pdf');
    }

    if ($type == 'download') {
        return $pdf->download('invoice.pdf');
    }
}

}
