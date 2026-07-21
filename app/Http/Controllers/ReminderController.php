<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function show(Tagihan $tagihan)
    {
        return view('reminder.show', compact('tagihan'));
    }

    public function kirim(Tagihan $tagihan)
    {
        // Nanti diganti dengan API WhatsApp Gateway

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Simulasi pengiriman reminder berhasil.');
    }
}