@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="margin:0;">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="btn-submit">+ Tambah Kategori</a>
    </div>

    @if (session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
    @endif

    @forelse ($categories as $category)
        <article class="card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h2 style="margin:0 0 .25rem;">{{ $category->name }}</h2>
                    <p style="margin:0;">Slug: {{ $category->slug }} &nbsp;|&nbsp;
                        Jumlah kegiatan: {{ $category->activities_count }}
                    </p>
                </div>
                <div style="display:flex; gap:.75rem;">
                    <a href="{{ route('categories.edit', $category) }}" class="btn-submit">Edit</a>
                    <form method="POST"
                          action="{{ route('categories.destroy', $category) }}"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </article>
    @empty
        <p class="empty">Belum ada kategori.</p>
    @endforelse
@endsection