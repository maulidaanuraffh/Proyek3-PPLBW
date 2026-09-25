@extends('layouts.app')

@section('title', 'Tambah Kegiatan')

@section('content')
    <a class="back-link" href="{{ route('activities.index') }}">&larr; Kembali ke daftar</a>

    <div class="detail-card">
        <h1 style="margin:0 0 1.5rem;">Tambah Kegiatan Baru</h1>

        <form method="POST" action="{{ route('activities.store') }}">
            @csrf
            @include('activities._form')
            <button type="submit" class="btn-submit">Simpan Kegiatan</button>
        </form>
    </div>
@endsection