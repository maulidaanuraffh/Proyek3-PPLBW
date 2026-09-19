Aplikasi kartu profil interaktif berbasis web yang dibangun menggunakan **HTML Semantik**, **CSS dengan variabel mode gelap**, serta **Vanilla JavaScript** murni. Aplikasi ini memuat data profil dan daftar keterampilan secara asinkron (Asynchronous JS) dari berkas JSON lokal dengan penanganan status antarmuka (*state handling*) yang aman dan aksesibel.

## Fitur Utama

* **Pemuatan Asinkron:** Mengambil data profil dan keterampilan langsung dari berkas `data/profile.json` menggunakan `fetch` dan `async-await`.
* **Manajemen Status UI (State Handling):** Menyediakan indikator visual yang jelas untuk status *loading*, *success*, *empty*, serta penanganan *error* lengkap dengan tombol coba lagi.
* **Aksesibilitas DOM & Toggle Detail:** Menampilkan dan menyembunyikan daftar keterampilan menggunakan manipulasi `classList` dan pembaruan atribut standar aksesibilitas `aria-expanded`.
* **Tema Dinamis:** Fitur mengubah skema warna antarmuka (Mode Terang ke Mode Gelap) secara *real-time*.
* **Validasi Formulir:** Mencegah penambahan data kosong pada input keterampilan dan otomatis memperbarui atribut `aria-invalid="true"`.
* **Manipulasi Array Dinamis:** Mengizinkan penambahan item keterampilan baru serta penghapusan item tertentu secara instan menggunakan metode `splice()` tanpa mendupikasi data lama di layar.
* **Proteksi Klik Ganda:** Mengunci proses pengiriman data selama pemuatan asinkron berlangsung agar permintaan ke server tidak berlipat ganda.

---

## Panduan Menjalankan Proyek Lewat Local Server

Karena aplikasi ini menggunakan arsitektur *Asynchronous JavaScript* (`fetch API`), browser akan memblokir pembacaan berkas jika file HTML dibuka secara langsung (keamanan CORS). Oleh karena itu, proyek **wajib dijalankan melalui local server**.

Berikut adalah langkah-langkah menjalankannya menggunakan ekstensi **Live Server** di VS Code:

### Langkah 1: Persiapan Folder Proyek
1. Pastikan struktur susunan berkas di dalam folder proyek Anda sudah sesuai seperti berikut:
   ```text
   ├── index.html
   ├── css
   ├   └── style.css
   ├── js
   ├   └── app.js
   ├── me.png
   └── data/
       └── profile.json
   ```

### Langkah 2: Membuka Proyek di VS Code
1. Jalankan aplikasi **Visual Studio Code**.
2. Pilih menu **File** -> **Open Folder...** -> Pilih folder utama proyek tempat berkas `index.html` berada.

### Langkah 3: Mengaktifkan Ekstensi Live Server
1. Klik kanan pada file **`index.html`** di kolom *Explorer* sebelah kiri VS Code.
2. Pilih opsi **Open with Live Server**.
3. *Alternatif lain:* Anda juga bisa mengklik tombol bertuliskan **`Go Live`** yang terletak di bilah status (*status bar*) berwarna biru di pojok kanan paling bawah jendela VS Code.

### Langkah 4: Pengujian di Browser
1. Browser utama Anda akan otomatis terbuka dan mengarah ke alamat alamat lokal, biasanya: `http://127.0.0`.
2. Aplikasi siap diuji coba dan dilakukan pengambilan tangkapan layar (*screenshot*) untuk pemenuhan berkas laporan praktikum.

---

## Struktur Data Lokal (`data/profile.json`)

Berkas data profil menggunakan format objek terstruktur dengan susunan sebagai berikut:
```json
{
  "nama": "Nama Lengkap Anda",
  "bio": "Deskripsi singkat profil mahasiswa.",
  "foto": "nama-file-foto-anda.jpg",
  "keterampilan": [
    "HTML Semantik",
    "CSS Responsif",
    "Vanilla JavaScript"
  ]
}
```
