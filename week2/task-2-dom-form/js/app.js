'use strict'; 
  
const peserta = [ 
  { id: 1, nama: 'Alya', prodi: 'Teknik Informatika' }, 
  { id: 2, nama: 'Bima', prodi: 'Sistem Informasi' }, 
]; 
  
const form = document.querySelector('#form-peserta'); 
const namaInput = document.querySelector('#nama'); 
const prodiInput = document.querySelector('#prodi'); 
const filterInput = document.querySelector('#filter-prodi'); 
const daftar = document.querySelector('#daftar-peserta'); 
const status = document.querySelector('#status'); 
const errorNama = document.querySelector('#error-nama'); 
const errorProdi = document.querySelector('#error-prodi'); 
  
function validasiPeserta(calon) { 
  // TODO: return object { valid, errorNama, errorProdi }. 
  let valid = true;
  let pesanErrorNama = '';
  let pesanErrorProdi = '';

  if (calon.nama.trim() === '') {
    pesanErrorNama = 'Nama tidak boleh kosong.';
    valid = false;
  } else if (calon.nama.trim().length < 3) {
    pesanErrorNama = 'Nama minimal harus 3 karakter.';
    valid = false;
  }

  if (calon.prodi === '') {
    pesanErrorProdi = 'Program studi harus dipilih.';
    valid = false;
  }

  return { valid, errorNama: pesanErrorNama, errorProdi: pesanErrorProdi };
} 
  
function buatKartuPeserta(item) { 
  // TODO: buat article, h2, dan p dengan createElement. 
  // Isi teks dengan textContent, lalu return article. 
  const article = document.createElement('article');
  const h2 = document.createElement('h2');
  const p = document.createElement('p');

  article.classList.add('peserta-card');
  h2.textContent = item.nama;
  p.textContent = `Program Studi: ${item.prodi}`;

  article.append(h2, p);
  return article;
} 
  
function renderPeserta(data) { 
  // TODO: kosongkan daftar, tangani data kosong, lalu append kartu. 
  // Mengosongkan daftar dengan aman
  daftar.replaceChildren();

  // Menangani kondisi jika data pencarian kosong
  if (data.length === 0) {
    const pesanKosong = document.createElement('p');
    pesanKosong.textContent = 'Tidak ada peserta';
    daftar.append(pesanKosong);
    status.textContent = '0 data tampil.';
    return;
  }

  // Menampilkan kartu jika ada data
  data.forEach(item => {
    daftar.append(buatKartuPeserta(item));
  });
  status.textContent = `${data.length} data tampil.`;
} 
  
form.addEventListener('submit', (event) => { 
  event.preventDefault(); 
  // TODO: baca nilai, validasi, atur aria-invalid dan pesan error. 
  // Jika valid, push object baru dengan id unik, reset, dan render. 
  event.preventDefault(); 
  
  const calonPeserta = {
    nama: namaInput.value,
    prodi: prodiInput.value
  };

  const hasilValidasi = validasiPeserta(calonPeserta);

  // Mengatur status aria-invalid dan menampilkan pesan error
  if (!hasilValidasi.valid) {
    namaInput.setAttribute('aria-invalid', hasilValidasi.errorNama ? 'true' : 'false');
    errorNama.textContent = hasilValidasi.errorNama;

    prodiInput.setAttribute('aria-invalid', hasilValidasi.errorProdi ? 'true' : 'false');
    errorProdi.textContent = hasilValidasi.errorProdi;
  } else {
    // Jika data valid, bersihkan penanda error
    namaInput.setAttribute('aria-invalid', 'false');
    errorNama.textContent = '';
    prodiInput.setAttribute('aria-invalid', 'false');
    errorProdi.textContent = '';

    // Push object baru dengan id unik (menggunakan timestamp agar selalu unik)
    const pesertaBaru = {
      id: Date.now(),
      nama: calonPeserta.nama.trim(),
      prodi: calonPeserta.prodi
    };
    peserta.push(pesertaBaru);

    // Reset input form dan kembalikan filter dropdown ke pilihan default 'semua'
    form.reset();
    filterInput.value = 'semua';

    // Render ulang dengan seluruh data peserta terbaru
    renderPeserta(peserta);
  }
}); 
  
filterInput.addEventListener('change', () => { 
  // TODO: jika 'semua' gunakan seluruh peserta; selain itu filter. 
  const pilihanFilter = filterInput.value;

  if (pilihanFilter === 'semua') {
    renderPeserta(peserta);
  } else {
    // Menggunakan array.filter() untuk menjaga data array asli
    const dataTersaring = peserta.filter(p => p.prodi === pilihanFilter);
    renderPeserta(dataTersaring);
  }
}); 
  
renderPeserta(peserta);