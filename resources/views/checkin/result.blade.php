@extends('layouts.app')

@section('content')
<div class="container mt-4 text-center">
    @if($status === 'success')
        <div class="alert alert-success">{{ $message }}</div>
    @elseif($status === 'warning')
        <div class="alert alert-warning">{{ $message }}</div>
    @else
        <div class="alert alert-danger">{{ $message }}</div>
    @endif

    @if(isset($booking))
        <h4>Nama: {{ $booking->user->name ?? 'Tidak diketahui' }}</h4>
        <p>Kode Tiket: {{ $booking->ticket_code }}</p>
        <p>Status: {{ $booking->is_checked_in ? 'Sudah Check-In' : 'Belum Check-In' }}</p>
    @endif

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
</div>
@endsection
