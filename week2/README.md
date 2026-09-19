# Praktikum Modul 2 - Maulida Nur Afifah / 251511017

## Ringkasan Halaman
Pengembangan landing page interaktif **Sunda Kiwari** (komunitas mahasiswa pencinta budaya Sunda) dengan mengimplementasikan interaksi dinamis berbasis **Vanilla JavaScript**. Halaman ini mempertahankan struktur dasar Modul 1 dan ditingkatkan dengan penambahan menu navigasi mobile, filter kategori divisi belajar (lokal), pemuatan cerita anggota secara asinkron dari berkas JSON eksternal, komponen FAQ accordion, validasi formulir pendaftaran, fitur *back to top*, serta penukar tema mode gelap. Seluruh manipulasi DOM menerapkan standar aksesibilitas dan keamanan tanpa framework.

## Tiga Keputusan Teknis
1. **Asynchronous Data Fetching dengan Promise Terkendali**  
   Data cerita anggota dipisahkan ke dalam berkas `data/testimoni.json` dan dimuat secara asinkron menggunakan fungsi `fetch()` dan `async-await`. Untuk menjamin keandalan performa jaringan, ditambahkan variabel status pengunci (*boolean flag*) `sedangMemuat`. Jika proses pengunduhan sedang berjalan, klik ganda atau penekanan tombol berulang secara cepat oleh pengguna akan langsung diabaikan oleh sistem.

2. **Manipulasi DOM yang Aman dan Efisien**  
   Pembuatan komponen kartu divisi dan testimoni dilakukan secara terprogram menggunakan metode `document.createElement()`. Data teks dimasukkan secara aman melalui properti `.textContent` (bukan `innerHTML`) untuk menutup celah keamanan dari serangan injeksi skrip berbahaya (*XSS*). Selain itu, pengosongan kontainer visual sebelum cetak ulang data menggunakan metode `.replaceChildren()` untuk menghindari terjadinya penumpukan atau duplikasi data ganda di layar.

3. **Sinkronisasi State Antarmuka dengan Standar Aksesibilitas (A11y)**  
   Perubahan visual antarmuka web selalu diselaraskan dengan pembaruan atribut penanda aksesibilitas. Komponen menu navigasi *hamburger* dan FAQ *accordion* secara dinamis memperbarui nilai atribut `aria-expanded` (true/false) saat diklik, sedangkan logika validasi formulir kontak akan langsung memicu atribut `aria-invalid="true"` ketika mendeteksi kolom nama atau email yang kosong/tidak valid.

## Masalah, Diagnosis, dan Perbaikan

| Masalah | Diagnosis | Perbaikan |
| :--- | :--- | :--- |
| Kartu lama menumpuk saat filter diubah atau saat memuat ulang data | Kontainer daftar tidak dibersihkan sebelum fungsi perulangan render baru dijalankan | Menambahkan skrip perintah `replaceChildren()` di baris awal fungsi `renderDivisi()` dan `renderTestimoni()`. |
| Pengiriman data kosong pada form pendaftaran lolos dan tidak terdeteksi | Kurangnya pengecekan kondisi teks dan tidak adanya pencegahan aksi bawaan (*default*) browser | Menyisipkan perintah `event.preventDefault()` di awal handler submit serta membuat fungsi kondisional pengecekan menggunakan `.trim()`. |
| Layar browser hilang total dan memunculkan error halaman saat menguji server mati | Melakukan penyegaran (*refresh*) halaman penuh saat koneksi local server diputus | Menguji kegagalan dengan membiarkan halaman tetap terbuka lalu mengklik tombol pemuatan data untuk memicu penanganan eror pada blok `catch`. |

## Hasil Pengujian Skenario Interaktif

| Skenario Uji | Tindakan | Hasil Aktual |
| :--- | :--- | :--- |
| **Pemuatan Awal** | Muat halaman pertama kali | Kartu divisi lokal langsung terbit, status memuat data testimoni aktif, lalu cerita anggota muncul secara asinkron dengan status sukses hijau. |
| **Filter Dropdown** | Memilih kategori "Teori" / "Praktik" | Kontainer kartu dibersihkan secara instan dan hanya menampilkan subset divisi belajar yang sesuai dengan pilihan filter pengguna. |
| **FAQ Accordion** | Mengklik salah satu baris pertanyaan | Panel jawaban yang dipilih terbuka dan mengubah tanda `+` menjadi `−` (`aria-expanded="true"`), sementara jawaban FAQ lainnya menutup otomatis. |
| **Validasi Input** | Klik submit dengan kolom nama/email kosong | Sistem menolak kiriman form, memunculkan notifikasi teks kesalahan merah, dan memberikan penanda batas bingkai merah (`aria-invalid="true"`). |
| **Ganti Tema** | Mengklik tombol "Mode Gelap" | Seluruh warna latar dan komponen berubah ke skema warna gelap secara instan akibat penambahan kelas `.dark-theme` pada elemen `<body>`. |
| **Back to Top** | Menggulir halaman turun melebihi 300px | Tombol melayang panah muncul stabil di pojok kanan bawah, dan saat diklik akan mengembalikan gulir ke posisi atas secara halus (*smooth*). |

## Refleksi Belajar
Praktikum Modul 2 ini memberikan pemahaman mendalam bahwa pengembangan web modern tidak hanya fokus pada keindahan visual statis, melainkan pada keandalan logika interaksi antarmuka. Saya belajar bagaimana mengelola status alur asinkron (*state handling*) untuk mengantisipasi ketidakpastian jaringan internet secara nyata menggunakan blok `try-catch-finally`. Kesalahan paling berharga yang saya alami adalah ketika lupa membersihkan kontainer DOM sebelum mencetak data baru, yang sempat menyebabkan penumpukan data berulang di layar. Dari kesalahan tersebut, saya memahami pentingnya metode pengosongan memori layar yang efisien. Selain itu, sinkronisasi atribut aksesibilitas menyadarkan saya bahwa setiap interaksi dinamis yang kita bangun dengan JavaScript wajib tetap ramah bagi pengguna perangkat bantu pembaca layar.

## Log AI atau Sumber Bantuan
Saya menggunakan AI sebagai asisten kolaboratif selama pengerjaan proyek Modul 2 ini. Dua alat utama yang saya optimalkan adalah **Claude** dan **DeepSeek**. Saya memanfaatkan keduanya untuk:
*   Mendapatkan saran mengenai teknik pengosongan elemen kontainer DOM yang aman menggunakan metode `replaceChildren()`.
*   Memahami penataan alur paralel pemuatan data eksternal secara asinkron via Fetch API dan penanganan status *loading/error*.
*   Mendiagnosis kesalahan logika pemrosesan data ganda dan merancang mekanisme *boolean flag* untuk mengunci tombol.
*   Menyusun struktur penulisan kalimat laporan dan merapikan dokumentasi repositori.

Seluruh keputusan arsitektur pemrograman, penamaan fungsi selektor, dan perbaikan baris kode akhir tetap saya ambil dan uji secara mandiri melalui browser DevTools (panel Elements, Console, dan Network) dengan tetap merujuk pada standar dokumentasi resmi Mozilla Developer Network (MDN).
