@extends('layouts.app')

@section('title', $activity->title)

@section('content')
    <a class="back-link" href="{{ route('activities.index') }}">&larr; Kembali ke daftar</a>

    <div class="detail-card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start;">
            <h1>{{ $activity->title }}</h1>
            <div style="display:flex; gap:.75rem;">
                <a href="{{ route('activities.edit', $activity) }}" class="btn-submit">Edit</a>

                <form method="POST"
                      action="{{ route('activities.destroy', $activity) }}"
                      onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                </form>
            </div>
        </div>

        <p class="detail-label">Tanggal Kegiatan</p>
        <p class="detail-value">{{ $activity->activity_date->format('d M Y') }}</p>

        <p class="detail-label">Kategori</p>
        <p class="detail-value">{{ $activity->category }}</p>

        <p class="detail-label">Status</p>
        <p class="detail-value">
            <span class="badge badge-{{ strtolower($activity->status) }}">
                {{ $activity->status }}
            </span>
        </p>

        <p class="detail-label">Deskripsi</p>
        <p class="detail-value">{{ $activity->description ?? '—' }}</p>

        <p class="detail-label">Dibuat</p>
        <p class="detail-value">{{ $activity->created_at->format('d M Y, H:i') }}</p>
    </div>
@endsection