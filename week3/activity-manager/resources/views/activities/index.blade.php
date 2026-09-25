@extends('layouts.app')

@section('title', 'Daftar Kegiatan')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1 style="margin:0;">Daftar Kegiatan</h1>
        <a href="{{ route('activities.create') }}" class="btn-submit">+ Tambah Kegiatan</a>
    </div>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('activities.index') }}" style="margin-bottom:1.5rem; display:flex; gap:1rem; flex-wrap:wrap;">
        <div>
            <label for="filter-status" style="font-size:.9rem; color:#6b7280;">Status</label>
            <select id="filter-status" name="status" onchange="this.form.submit()"
                    style="display:block; padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-family:inherit;">
                <option value="">Semua Status</option>
                @foreach (['Planned', 'Ongoing', 'Done'] as $s)
                    <option value="{{ $s }}" @selected($filterStatus === $s)>{{ $s }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="filter-category" style="font-size:.9rem; color:#6b7280;">Kategori</label>
            <select id="filter-category" name="category" onchange="this.form.submit()"
                    style="display:block; padding:.4rem .7rem; border:1px solid #d1d5db; border-radius:6px; font-family:inherit;">
                <option value="">Semua Kategori</option>
                @foreach (['Workshop', 'Seminar', 'Praktikum'] as $c)
                    <option value="{{ $c }}" @selected($filterCategory === $c)>{{ $c }}</option>
                @endforeach
            </select>
        </div>

        @if ($filterStatus || $filterCategory)
            <div style="align-self:flex-end;">
                <a href="{{ route('activities.index') }}"
                style="display:inline-block; padding:.4rem .8rem; background:#f3f4f6; border:1px solid #d1d5db; border-radius:6px; font-size:.9rem; color:#374151; text-decoration:none;">
                    Reset filter
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