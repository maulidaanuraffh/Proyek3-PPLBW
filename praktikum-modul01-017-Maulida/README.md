# Praktikum Modul 1 - Maulida Nur Afifah [251511017] 2A

## Ringkasan Halaman
Halaman ini adalah profil mahasiswa D3 Teknik Informatika yang menampilkan:
- Identitas diri (judul, foto, deskripsi singkat)
- Daftar keterampilan (HTML, CSS, Problem Solving)
- Tautan kontak melalui email

Struktur menggunakan HTML semantik (`header`, `nav`, `main`, `section`, `footer`) dan
tampilan diatur dengan CSS eksternal (`css/style.css`) menggunakan custom properties,
flexbox, serta pendekatan *mobile-first*. Halaman responsif untuk lebar 320px, 375px,
768px, dan 1024px.

## Tiga Keputusan Teknis
1. **Penggunaan HTML Semantik**  
   Mengganti `<div>` dengan `<header>`, `<nav>`, `<main>`, `<section>`, dan `<footer>`
   agar struktur lebih mudah dipahami oleh *screen reader* dan mesin pencari. Setiap
   bagian utama diberi heading `<h2>` untuk menjaga hierarki.

2. **Desain dengan Custom Properties dan Reusable Class**  
   Warna, spacing, dan radius didefinisikan sebagai token di `:root` (misal `--color-primary`,
   `--spacing-xl`). Class seperti `.card`, `.button`, dan `.nav-link` dipakai ulang sehingga
   kode lebih ringkas dan konsisten.

3. **Layout Responsif dengan Flexbox dan Media Query**  
   `.card-list` menggunakan `display: flex` dengan `flex-direction: column` (mobile) dan
   berubah menjadi `row` pada `min-width: 768px`. Setiap `.card` diberi `flex: 1 1 300px`
   dan `flex-wrap: wrap` untuk mencegah *overflow* pada layar kecil.

## Masalah, Diagnosis, dan Perbaikan
| Masalah | Diagnosis | Perbaikan |
|--------|-----------|-----------|
| Horizontal scroll pada 320px | `.card` terlalu lebar karena padding menambah lebar total | Menambahkan `box-sizing: border-box` secara global dan `flex-wrap: wrap` pada `.card-list` |
| Navigasi tidak responsif | Tautan navigasi berdesakan pada layar kecil | Menambahkan `flex-wrap: wrap` pada `.nav-wrapper` dan `gap` yang konsisten |
| Teks panjang merusak layout | Tidak ada pengaturan `overflow-wrap` | Menambahkan `overflow-wrap: break-word` pada `.card` |

## Hasil Pengujian Empat Viewport
| Viewport | Hasil |
|----------|-------|
| 320px | Satu kolom, tidak ada horizontal scroll, navigasi tetap terbaca |
| 375px | Satu kolom, tampilan rapi, tombol dapat diakses keyboard |
| 768px | Kartu mulai berjajar (dua kolom) karena media query |
| 1024px | Tiga kartu sejajar dalam satu baris, layout stabil |

*Screenshot lengkap tersedia di folder `evidence/`.*

## Refleksi Belajar
Praktikum ini mengajarkan bahwa struktur HTML yang semantik sangat memengaruhi
aksesibilitas dan kemudahan styling. Keputusan teknis paling berpengaruh adalah
penggunaan `box-sizing: border-box` dan `flex-wrap`—tanpa itu, layout mudah rusak
di layar kecil. Saya juga belajar bahwa *breakpoint* harus ditentukan berdasarkan
kebutuhan konten, bukan sekadar mengejar ukuran perangkat. Kesalahan awal seperti
lupa menambahkan `flex-wrap` membuat saya memahami cara kerja *main axis* dan
*cross axis* pada flexbox. Ke depannya, saya perlu meningkatkan pengujian keyboard
dan memastikan semua elemen interaktif memiliki indikator fokus yang jelas.

## Log AI atau Sumber Bantuan
Menggunakan Claude untuk diskusi dan pemberian clue untuk memahami pemetaan elemen semantik dan konsep CSS (cascade, box model, flexbox) secara bertahap. Debugging dilakukan dengan DevTools (tab Elements, Console, dan Network) serta validator W3C untuk memastikan tidak ada error struktur.