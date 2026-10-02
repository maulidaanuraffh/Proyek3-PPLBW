@extends('layouts.app')

@section('title', 'Daftar: ' . $activity->title)

@section('content')
    <a class="back-link" href="{{ route('activities.show', $activity) }}">&larr; Kembali ke detail</a>

    <div class="detail-card">
        <h1 style="margin:0 0 .5rem;">Daftar Kegiatan</h1>
        <p style="color:#6b7280; margin-bottom:1.5rem;">{{ $activity->title }}</p>

        <p>Kapasitas: {{ $activity->registered_count }} / {{ $activity->capacity }} peserta</p>

        <form method="POST" action="{{ route('activities.register.store', $activity) }}">
            @csrf

            <div class="form-group">
                <label for="participant_name">Nama Lengkap</label>
                <input id="participant_name" name="participant_name" type="text"
                       value="{{ old('participant_name') }}" maxlength="150" required>
                @error('participant_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" maxlength="150" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
    </div>
@endsection
