@extends('layouts.app')

@section('title', 'Edit: ' . $activity->title)

@section('content')
    <a class="back-link" href="{{ route('activities.show', $activity) }}">&larr; Kembali ke detail</a>

    <div class="detail-card">
        <h1 style="margin:0 0 1.5rem;">Edit Kegiatan</h1>

        <form method="POST" action="{{ route('activities.update', $activity) }}">
            @csrf
            @method('PUT')
            @include('activities._form')
            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
@endsection