'use strict'; 
  
const status = document.querySelector('#status'); 
const daftar = document.querySelector('#daftar-materi'); 
const tombolMuat = document.querySelector('#muat'); 
const tombolCobaLagi = document.querySelector('#coba-lagi'); 
  
function aturState(state, pesan) { 
  status.dataset.state = state; 
  status.textContent = pesan; 
  tombolCobaLagi.hidden = state !== 'error'; 
} 
  
async function ambilMateri() { 
  // Melakukan fetch ke data/materi.json
  const response = await fetch('data/materi.json'); 
  
  // Jika response.ok bernilai false, lempar Error yang informatif
  if (!response.ok) { 
    throw new Error(`Gagal memuat data (HTTP ${response.status})`); 
  } 
  
  // Mengembalikan hasil konversi objek JSON
  return response.json(); 
} 
  
function renderMateri(data) { 
  // Mengosongkan daftar sebelum mencetak elemen baru
  daftar.replaceChildren(); 
  
  data.forEach(item => {
    const article = document.createElement('article');
    const h2 = document.createElement('h2');
    const p = document.createElement('p');

    article.classList.add('kartu');
    h2.textContent = item.judul;
    p.textContent = `Durasi Belajar: ${item.durasi} menit`;

    article.append(h2, p);
    daftar.append(article);
  });
} 
  
async function muatData() { 
  aturState('loading', 'Memuat data...'); 
  tombolMuat.disabled = true; 
  daftar.replaceChildren(); 
  
  try { 
    // Menunggu hasil pembacaan data via async-await
    const data = await ambilMateri(); 
  
    // Membedakan array kosong dan data berisi
    if (!Array.isArray(data) || data.length === 0) {
      aturState('empty', 'Tidak ada data materi tersedia.');
    } else {
      renderMateri(data);
      aturState('success', `Berhasil menampilkan ${data.length} materi.`); 
    }
  } catch (error) { 
    console.error(error); 
    // Tampilkan state error dengan pesan yang dipahami pengguna
    aturState('error', `Terjadi kesalahan teknis: ${error.message}`); 
  } finally { 
    // Aktifkan kembali tombol Muat data di akhir proses
    tombolMuat.disabled = false; 
  } 
} 
  
tombolMuat.addEventListener('click', muatData); 
tombolCobaLagi.addEventListener('click', muatData);
