@extends('layouts.app')

@section('title', 'Daftar Kegiatan')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="margin:0;">Daftar Kegiatan</h1>
        <a href="{{ route('activities.create') }}" class="btn-submit">+ Tambah Kegiatan</a>
        <a href="{{ route('activities.trashed') }}"
        style="display:inline-block; padding:.6rem 1rem; background:#f3f4f6; border:1px solid #d1d5db; border-radius:6px; color:#374151; text-decoration:none; font-size:.95rem;">
            Lihat yang dihapus
        </a>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('activities.index') }}"
        style="display:flex; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">

        <div>
            <label for="search" style="display:block; font-size:.9rem; color:#6b7280;">Cari</label>
            <input id="search" name="search" type="text"
                value="{{ request('search') }}"
                placeholder="Kode atau judul..."
                style="padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px;">
        </div>

        <div>
            <label for="category_id" style="display:block; font-size:.9rem; color:#6b7280;">Kategori</label>
            <select id="category_id" name="category_id"
                    style="padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px;">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                        @selected(request('category_id') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status" style="display:block; font-size:.9rem; color:#6b7280;">Status</label>
            <select id="status" name="status"
                    style="padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px;">
                <option value="">Semua Status</option>
                @foreach (['draft', 'published', 'completed'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="sort" style="display:block; font-size:.9rem; color:#6b7280;">Urutan</label>
            <select id="sort" name="sort"
                    style="padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px;">
                <option value="terbaru" @selected(request('sort') === 'terbaru')>Terbaru</option>
                <option value="terlama" @selected(request('sort') === 'terlama')>Terlama</option>
            </select>
        </div>

        <div style="align-self:flex-end;">
            <button type="submit" class="btn-submit">Terapkan</button>
        </div>

        @if (request()->hasAny(['search', 'category_id', 'status', 'sort']))
            <div style="align-self:flex-end;">
                <a href="{{ route('activities.index') }}"
                style="display:inline-block; padding:.5rem .9rem; background:#f3f4f6; border:1px solid #d1d5db; border-radius:6px; color:#374151; text-decoration:none;">
                    Reset
                </a>
            </div>
        @endif
    </form>

    @forelse ($activities as $activity)
        <article class="card">
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>
                Kategori: {{ $activity->category->name }} &nbsp;|&nbsp;
                <span class="badge badge-{{ strtolower($activity->status) }}">
                    {{ $activity->status }}
                </span>
            </p>
        </article>
    @empty
        <p class="empty">Belum ada kegiatan.</p>
    @endforelse
@endsection
