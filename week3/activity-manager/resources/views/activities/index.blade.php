@extends('layouts.app')

@section('title', 'Daftar Kegiatan')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="margin:0;">Daftar Kegiatan</h1>
        <a href="{{ route('activities.create') }}" class="btn-submit">+ Tambah Kegiatan</a>
    </div>

    @forelse ($activities as $activity)
        <article class="card">
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>
                Kategori: {{ $activity->category }} &nbsp;|&nbsp;
                <span class="badge badge-{{ strtolower($activity->status) }}">
                    {{ $activity->status }}
                </span>
            </p>
        </article>
    @empty
        <p class="empty">Belum ada kegiatan.</p>
    @endforelse
@endsection