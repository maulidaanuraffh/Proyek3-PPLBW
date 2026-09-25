## Keputusan Arsitektur

### Filter dengan Local Scope
Filter status dan kategori pada daftar kegiatan menggunakan local scope
(`scopeOfStatus`, `scopeOfCategory`) di Eloquent model, bukan kondisi
langsung di controller. Alasannya: scope membuat query filter dapat
digunakan ulang dari tempat lain tanpa menduplikasi logika validasi
nilai filter, dan controller tetap fokus pada orkestrasi request.

### Business Rule Transisi Status di Service
Aturan transisi status (Planned → Ongoing → Done) ditempatkan di
`ActivityService`, bukan di controller atau Blade. Alasannya: aturan
ini membutuhkan pengetahuan state sebelumnya dari database dan
merupakan aturan domain, sehingga harus dapat diuji terpisah dari
layer HTTP.