<x-app-layout>

<div class="container-fluid">

@php

$pesan = "Yth. {$tagihan->pelanggan->nama_pelanggan},

Kami mengingatkan bahwa tagihan listrik Anda dengan rincian berikut:

ID Pelanggan : {$tagihan->pelanggan->id_pelanggan}
Periode : {$tagihan->periode}
Nominal : Rp " . number_format($tagihan->nominal,0,',','.') . "
Jatuh Tempo : " . $tagihan->jatuh_tempo->format('d-m-Y') . "

Mohon segera melakukan pembayaran sebelum jatuh tempo.

Terima kasih.
PT PLN (Persero) ULP Way Halim";

@endphp

<div class="row">

<div class="col-lg-8">

<div class="card shadow-sm border-0 rounded-4">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

<i class="bi bi-whatsapp"></i>

Preview Reminder WhatsApp

</h4>

</div>

<div class="card-body">

<div class="mb-4">

<h6 class="fw-bold">

Data Pelanggan

</h6>

<hr>

<table class="table table-borderless">

<tr>

<th width="180">

Nama

</th>

<td>

{{ $tagihan->pelanggan->nama_pelanggan }}

</td>

</tr>

<tr>

<th>

ID Pelanggan

</th>

<td>

{{ $tagihan->pelanggan->id_pelanggan }}

</td>

</tr>

<tr>

<th>

Nomor WhatsApp

</th>

<td>

{{ $tagihan->pelanggan->nomor_whatsapp }}

</td>

</tr>

<tr>

<th>

Periode

</th>

<td>

{{ $tagihan->periode }}

</td>

</tr>

<tr>

<th>

Nominal

</th>

<td>

Rp {{ number_format($tagihan->nominal,0,',','.') }}

</td>

</tr>

<tr>

<th>

Jatuh Tempo

</th>

<td>

{{ $tagihan->jatuh_tempo->format('d F Y') }}

</td>

</tr>

</table>

</div>

<h6 class="fw-bold">

Preview Pesan

</h6>

<hr>

<div
style="
background:#e5ddd5;
padding:25px;
border-radius:15px;">

<div
style="
background:white;
padding:20px;
border-radius:12px;
white-space:pre-line;
font-size:15px;
line-height:1.7;">

{{ $pesan }}

</div>

</div>

</div>

<div class="card-footer bg-white d-flex justify-content-between">

<a
href="{{ route('tagihan.index') }}"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>

Kembali

</a>

<form action="{{ route('tagihan.send',$tagihan->id) }}"
        method="POST">

    @csrf

    <button class="btn btn-success">
        <i class="bi bi-whatsapp"></i>
        Kirim WhatsApp
    </button>

</form>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card border-0 shadow-sm rounded-4">

<div class="card-body text-center">

<i
class="bi bi-phone-fill text-success"
style="font-size:90px"></i>

<h5 class="mt-3">

WhatsApp Gateway

</h5>

<p class="text-muted">

Pesan akan dikirim ke nomor pelanggan melalui WhatsApp.

</p>

<hr>

<p>

Status Tagihan

</p>

@if($tagihan->status_pembayaran=="Belum Bayar")

<span class="badge bg-warning fs-6">

Belum Bayar

</span>

@else

<span class="badge bg-success fs-6">

Lunas

</span>

@endif

</div>

</div>

</div>

</div>

</div>

</x-app-layout>