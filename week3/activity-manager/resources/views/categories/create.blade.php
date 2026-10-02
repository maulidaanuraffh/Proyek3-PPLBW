@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <a class="back-link" href="{{ route('categories.index') }}">&larr; Kembali</a>

    <div class="detail-card">
        <h1 style="margin:0 0 1.5rem;">Tambah Kategori</h1>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input id="name" name="name" type="text"
                       value="{{ old('name') }}" maxlength="100">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input id="slug" name="slug" type="text"
                       value="{{ old('slug') }}" maxlength="100">
                @error('slug')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>
@endsection