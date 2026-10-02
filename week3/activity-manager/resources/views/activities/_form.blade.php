{{-- Partial form dipakai oleh create.blade.php dan edit.blade.php --}}

<div class="form-group">
    <label for="title">Judul</label>
    <input id="title" name="title" type="text"
           value="{{ old('title', $activity->title ?? '') }}"
           maxlength="100">
    @error('title')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea id="description" name="description"
              rows="3">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $activity->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="code">Kode Kegiatan</label>
    <input id="code" name="code" type="text"
           value="{{ old('code', $activity->code ?? '') }}"
           maxlength="30">
    @error('code')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="location">Lokasi</label>
    <input id="location" name="location" type="text"
           value="{{ old('location', $activity->location ?? '') }}"
           maxlength="150">
    @error('location')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="capacity">Kapasitas</label>
    <input id="capacity" name="capacity" type="number"
           value="{{ old('capacity', $activity->capacity ?? '') }}"
           min="1" max="500">
    @error('capacity')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="start_at">Tanggal Mulai</label>
    <input id="start_at" name="start_at" type="datetime-local"
           value="{{ old('start_at', isset($activity->start_at) ? $activity->start_at?->format('Y-m-d\TH:i') : '') }}">
    @error('start_at')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="end_at">Tanggal Selesai</label>
    <input id="end_at" name="end_at" type="datetime-local"
           value="{{ old('end_at', isset($activity->end_at) ? $activity->end_at?->format('Y-m-d\TH:i') : '') }}">
    @error('end_at')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status">
         @foreach (['draft', 'published', 'completed'] as $s)
            <option value="{{ $s }}"
                @selected(old('status', $activity->status ?? 'Planned') === $s)>
                {{ $s }}
            </option>
        @endforeach
    </select>
    @error('status')
        <p class="error">{{ $message }}</p>  {{-- pesan DomainException muncul di sini --}}
    @enderror
</div>
