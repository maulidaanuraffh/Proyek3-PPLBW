# Praktikum Modul 1 - Maulida Nur Afifah / 251511017

## Ringkasan Halaman
Landing page **Sunda Kiwari**  komunitas mahasiswa yang belajar bahasa, aksara,
kesenian, dan budaya Sunda. Halaman ini punya hero dengan contoh aksara Sunda,
section yang menjelaskan empat divisi belajar, jadwal rutin, kutipan anggota,
dan ajakan gabung. Semua dibangun pakai HTML semantik + CSS eksternal,
mobile-first, tanpa framework.

## Tiga Keputusan Teknis
1. **Struktur semantik**  
   Pakai `<header>`, `<nav>`, `<main>`, `<section>`, `<figure>`, `<blockquote>`,
   dan `<footer>` biar screen reader dan mesin pencari paham isi halaman. Setiap
   section punya heading yang runtut, cuma ada satu `<h1>` di hero.

2. **Flexbox + breakpoint berbasis konten**  
   Default mobile: `flex-direction: column` biar rapi di layar kecil. Breakpoint
   `640px` dipakai buat bikin kartu, jadwal, dan cerita anggota jadi baris.
   Breakpoint `900px` dipakai buat hero dua kolom. Angka ini dipilih karena di
   lebar itulah konten mulai sempit kalau dipaksa satu kolom.

3. **Token warna dan spacing**  
   Warna (hejo awi, kunyit, tinta) dan spacing didefinisikan sebagai custom
   properties di `:root`. Jadi kalau mau ganti tema, cukup ubah satu variabel,
   nggak perlu nyari manual di seluruh file.

## Masalah, Diagnosis, dan Perbaikan
| Masalah | Diagnosis | Perbaikan |
|--------|-----------|-----------|
| Horizontal scroll di 320px | Padding nambah lebar elemen karena `box-sizing` default | Set `box-sizing: border-box` global, `overflow-wrap: break-word` di body |
| Teks panjang keluar dari kartu | Nggak ada pengaturan wrap | Tambah `overflow-wrap: break-word` dan `min-width: 0` di flex item |
| Gambar cerita keliatan lonjong | Nggak ada aspect ratio | Pakai `aspect-ratio: 4/3` + `object-fit: cover` |

## Hasil Pengujian Viewport
| Viewport | Hasil |
|----------|-------|
| 320px | Satu kolom, no overflow, nav tetap kebaca |
| 375px | Satu kolom, tombol bisa di-tab, tampilan rapi |
| 768px | Kartu mulai dua kolom, jadwal jadi baris |
| 1024px | Hero dua kolom, kartu empat kolom, layout stabil |

Screenshot ada di folder `evidence/`.

## Refleksi Belajar (250-350 kata)
Praktikum ini mengajarkan bahwa struktur HTML yang semantik itu bukan cuma
soal "rapi", tapi beneran ngaruh ke aksesibilitas. Terasa penting ketika coba navigasi pakai
keyboard `:focus-visible` dan urutan heading yang
bener. Keputusan teknis yang paling ngaruh menurutku `box-sizing: border-box`
dan `flex-wrap`. Dua hal itu yang bikin layout nggak berantakan di layar 320px.

Selain itu breakpoint harus ditentukan dari kebutuhan konten,
bukan sekadar ngejar ukuran HP tertentu. Kesalahan yang paling bikin belajar adalah pas
aku lupa nambah `min-width: 0` di flex item, jadi teks panjang malah bikin
container melebar. Dari situ aku paham cara kerja flex item dan overflow.


## Log AI atau Sumber Bantuan
Saya menggunakan AI sebagai asisten selama pengerjaan proyek ini. Dua alat yang
saya pakai adalah **Claude** dan **DeepSeek**. Saya manfaatkan keduanya untuk:
- Bertanya soal konsep Flexbox, `box-sizing`, dan media query.
- Meminta saran struktur HTML semantik dan penamaan class.
- Debugging error layout, misalnya overflow di 320px.
- Menyusun draft README dan merapikan dokumentasi.

Semua keputusan akhir tetap saya ambil sendiri. Saya cek ulang setiap saran AI
dengan uji coba di browser dan validator. Dokumentasi resmi seperti MDN juga
saya jadikan rujukan utama.