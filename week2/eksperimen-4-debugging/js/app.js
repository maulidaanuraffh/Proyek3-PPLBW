'use strict'; 
  
const form = document.querySelector('#form-hitung'); 
const hargaInput = document.querySelector('#harga'); 
const jumlahInput = document.querySelector('#jumlah'); 
const hasil = document.querySelector('#hasil'); 
const pesan = document.querySelector('#pesan'); 
  
function hitungTotal(harga, jumlah) { 
  return harga * jumlah; 
} 
  
function tampilkanPesan(teks) { 
  pesan.textContent = teks; 
} 
  
function prosesForm(event) { 
  console.count('prosesForm'); 
  event.preventDefault(); 
  
  const harga = Number(hargaInput.value); 
  const jumlah = Number(jumlahInput.value); 
  
  if (harga <= 0 || jumlah <= 0) { 
    tampilkanPesan('Harga dan jumlah harus positif.'); 
    return; 
  } 
  
  const total = hitungTotal(harga, jumlah); 
  hasil.textContent = total.toLocaleString('id-ID'); 
  tampilkanPesan('Perhitungan berhasil.'); 
} 
  
form.addEventListener('submit', prosesForm); 
form.addEventListener('submit', (event) => { 
prosesForm(event); 
}); 

function hitungSubtotal(harga, jumlah) {
  return harga * jumlah;
}

// Menentukan Persentase Diskon Dasar Berdasarkan Subtotal
function tentukanDiskonDasar(subtotal) {
  if (subtotal >= 200000) return 0.20; // Diskon 20%
  if (subtotal >= 100000) return 0.10; // Diskon 10%
  return 0.0;
}

// Menggabungkan Diskon dan Membatasi Maksimal 25%
function hitungTotalDiskon(diskonDasar, isAnggota) {
  let totalDiskon = diskonDasar;
  if (isAnggota) {
    totalDiskon += 0.05; // Tambahan anggota 5%
  }
  // Membatasi total diskon maksimal 25% (0.25)
  return Math.min(totalDiskon, 0.25);
}

// Memproses Input dan Mengembalikan Object Ringkasan
function buatRingkasanPembayaran(harga, jumlah, isAnggota) {
  //Cek apakah input valid
  if (typeof harga !== 'number' || typeof jumlah !== 'number' || Number.isNaN(harga) || Number.isNaN(jumlah) || harga <= 0 || jumlah <= 0) {
    return {
      subtotal: 0,
      persenDiskon: '0%',
      totalBayar: 0,
      status: 'Data tidak valid'
    };
  }

  const subtotal = hitungSubtotal(harga, jumlah);
  const diskonDasar = tentukanDiskonDasar(subtotal);
  const totalDiskon = hitungTotalDiskon(diskonDasar, isAnggota);
  const nilaiPotongan = subtotal * totalDiskon;
  const totalBayar = subtotal - nilaiPotongan;

  return {
    subtotal: subtotal,
    persenDiskon: `${totalDiskon * 100}%`,
    totalBayar: totalBayar,
    status: 'Perhitungan berhasil'
  };
}