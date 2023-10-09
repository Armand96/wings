<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class TransactionHeaderController extends Controller
{

    public function getReports(Request $request)
    {
        $data = $request->only(['start_date', 'end_date']);
        $data['start_date'] = isset($data['start_date']) ? $data['start_date'] : date('Y-m-d');
        $data['end_date'] = isset($data['end_date']) ? $data['end_date'] : date('Y-m-d');
        $trxHeaders = TransactionHeader::with(['detail', 'detail.product'])->whereBetween('date', [$data['start_date'], $data['end_date']])->get();
        return view('admin.report.report', compact('trxHeaders'));
    }

    public function print(Request $request)
    {
        $data = $request->only(['start_date', 'end_date']);
        $data['start_date'] = isset($data['start_date']) ? $data['start_date'] : date('Y-m-d');
        $data['end_date'] = isset($data['end_date']) ? $data['end_date'] : date('Y-m-d');
        $trxHeaders = TransactionHeader::with(['detail', 'detail.product'])->whereBetween('date', [$data['start_date'], $data['end_date']])->get();
        return view('admin.report.print', compact('trxHeaders'));
    }
}
