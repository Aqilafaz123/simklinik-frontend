@extends('layouts.app')

@php($pageTitle = 'Dashboard')

@section('content')
<div class="cards">
  <div class="card stat">
    <div><div class="num">{{ (int) $pasienHariIni }}</div><div class="lbl">Pasien Hari Ini</div></div>
    <div class="ico bg-blue">{!! app_icon('users') !!}</div>
  </div>
  <div class="card stat">
    <div><div class="num">{{ (int) $antrianAktif }}</div><div class="lbl">Antrian Aktif</div></div>
    <div class="ico bg-orange">{!! app_icon('ticket') !!}</div>
  </div>
  <div class="card stat">
    <div><div class="num">{{ rupiah($pendapatanHariIni) }}</div><div class="lbl">Pendapatan Hari Ini</div></div>
    <div class="ico bg-green">{!! app_icon('money') !!}</div>
  </div>
  <div class="card stat">
    <div><div class="num">{{ (int) $totalPasien }}</div><div class="lbl">Total Pasien Terdaftar</div></div>
    <div class="ico bg-purple">{!! app_icon('idcard') !!}</div>
  </div>
  <div class="card stat">
    <div><div class="num">{{ (int) $stokMenipis }}</div><div class="lbl">Obat Stok Menipis</div></div>
    <div class="ico bg-red">{!! app_icon('pills') !!}</div>
  </div>
</div>

<div class="section-title">Antrian Hari Ini</div>
<div class="table-wrap">
  <table class="datatable no-auto-num" style="width:100%">
    <thead>
      <tr><th>No. Antrian</th><th>Pasien</th><th>Poli</th><th>Dokter</th><th>Status</th></tr>
    </thead>
    <tbody>
      @foreach($antrian as $a)
        <tr>
          <td><b>{{ $a->poli }}-{{ str_pad($a->no_antrian, 3, '0', STR_PAD_LEFT) }}</b></td>
          <td>{{ $a->pasien }}</td>
          <td>{{ $a->poli }}</td>
          <td>{{ $a->dokter ?? '-' }}</td>
          <td><span class="badge {{ $badgeMap[$a->status] ?? 'badge-gray' }}">{{ ucfirst($a->status) }}</span></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
