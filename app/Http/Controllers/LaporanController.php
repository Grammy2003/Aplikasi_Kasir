<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Method to display the form for selecting the period
    public function index()
    {
        return view('laporan.index'); // Ensure you have a view 'laporan.index' file
    }

    // Generate PDF based on the selected period
    public function laporanPenjualan(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if (!$startDate || !$endDate) {
            return redirect()->route('laporan.index')->with('error', 'Silakan pilih periode terlebih dahulu.');
        }

        $transaksis = TransaksiPenjualan::with(['pelanggan', 'details.product'])
            ->whereBetween('TglPenjualan', [$startDate, $endDate])
            ->get();

        $pdf = Pdf::loadView('laporan.penjualan', compact('transaksis', 'startDate', 'endDate'));

        return $pdf->stream('Laporan_Penjualan.pdf');
    }
}
