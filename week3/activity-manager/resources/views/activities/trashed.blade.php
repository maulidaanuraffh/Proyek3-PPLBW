@extends('layouts.app')

@section('title', 'Kegiatan Terhapus')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="margin:0;">Kegiatan Terhapus</h1>
        <a href="{{ route('activities.index') }}" class="btn-submit">
            &larr; Kembali ke daftar aktif
        </a>
    </div>

    @forelse ($activities as $activity)
        <article class="card">
            <h2 style="margin:0 0 .4rem;">{{ $activity->title }}</h2>
            <p>Kode: {{ $activity->code }}</p>
            <p>Kategori: {{ $activity->category->name }}</p>
            <p>Dihapus: {{ $activity->deleted_at->format('d M Y, H:i') }}</p>

            <form method="POST"
                  action="{{ route('activities.restore', $activity) }}"
                  style="margin-top:.75rem;">
                @csrf
                <button type="submit" class="btn-submit">Pulihkan</button>
            </form>
        </article>
    @empty
        <p class="empty">Tidak ada kegiatan yang dihapus.</p>
    @endforelse

    <div style="margin-top:1.5rem;">
        {{ $activities->links() }}
    </div>
@endsection
