<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $paymentTypes = PaymentType::latest()->get();
        return view('admin.payment-types.index', compact('paymentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        PaymentType::create($request->all());

        return redirect()->back()->with('success', 'Tipe pembayaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        PaymentType::findOrFail($id)->update($request->all());

        return redirect()->back()->with('success', 'Tipe pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        PaymentType::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Tipe pembayaran berhasil dihapus');
    }
}
