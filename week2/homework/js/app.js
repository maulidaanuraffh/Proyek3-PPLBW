'use strict';

// 1. DOM Selectors
const profileCard = document.querySelector('#profile-card');
const statusInfo = document.querySelector('#status-info');
const btnCobaLagi = document.querySelector('#btn-coba-lagi');
const btnTema = document.querySelector('#btn-tema');

// Elemen di dalam kartu profil
const fotoProfil = document.querySelector('#foto-profil');
const namaProfil = document.querySelector('#nama-profil');
const bioProfil = document.querySelector('#bio-profil');
const btnDetail = document.querySelector('#btn-detail');
const panelDetail = document.querySelector('#panel-detail');
const daftarSkill = document.querySelector('#daftar-skill');

// Elemen Form Penambahan Skill
const formSkill = document.querySelector('#form-skill');
const inputSkill = document.querySelector('#input-skill');
const errorSkill = document.querySelector('#error-skill');

// Data State Internal Aplikasi
let dataSkills = [];
let sedangMemuat = false;

// 2. Fungsi Mengatur State Tampilan Antarmuka
function aturState(state, pesan) {
  statusInfo.dataset.state = state;
  statusInfo.textContent = pesan;
  
  // Sembunyikan atau tunjukkan kartu berdasarkan state
  profileCard.hidden = (state === 'loading' || state === 'error');
  btnCobaLagi.hidden = (state !== 'error');
}

// 3. Fungsi Asinkron Mengambil Data JSON
async function ambilDataProfil() {
  const response = await fetch('data/profile.json');
  if (!response.ok) {
    throw new Error(`HTTP ${response.status}`);
  }
  return response.json();
}

// 4. Fungsi Merender Keterampilan (Skill) ke DOM
function renderSkills() {
  daftarSkill.replaceChildren();

  // Menangani kondisi jika semua skill dihapus
  if (dataSkills.length === 0) {
    const itemKosong = document.createElement('li');
    itemKosong.classList.add('pesan-kosong');
    itemKosong.textContent = 'Tidak ada keterampilan tersedia.';
    daftarSkill.append(itemKosong);
    return;
  }

  dataSkills.forEach((skill, indeks) => {
    const li = document.createElement('li');
    const span = document.createElement('span');
    const btnHapus = document.createElement('button');

    span.textContent = skill;
    btnHapus.type = 'button';
    btnHapus.textContent = 'Hapus';
    btnHapus.classList.add('btn-hapus');
    
    // Fitur Hapus Keterampilan
    btnHapus.addEventListener('click', () => {
      dataSkills.splice(indeks, 1);
      renderSkills();
    });

    li.append(span, btnHapus);
    daftarSkill.append(li);
  });
}

// 5. Fungsi Utama Pemuatan Data Aplikasi
async function muatAplikasi() {
  if (sedangMemuat) return; // Mencegah klik ganda berulang
  sedangMemuat = true;

  aturState('loading', 'Memuat profil...');
  
  try {
    const data = await ambilDataProfil();
    
    // Menangani penafsiran struktur data kosong
    if (!data || Object.keys(data).length === 0) {
      aturState('empty', 'Data profil kosong.');
      return;
    }

    // Mengisi informasi profil ke elemen DOM secara aman
    fotoProfil.src = data.foto || 'placeholder.png';
    namaProfil.textContent = data.nama;
    bioProfil.textContent = data.bio;
    dataSkills = Array.isArray(data.keterampilan) ? [...data.keterampilan] : [];
    
    renderSkills();
    aturState('success', 'Profil berhasil dimuat.');
  } catch (error) {
    console.error(error);
    aturState('error', `Gagal memuat profil: ${error.message}`);
  } finally {
    sedangMemuat = false;
  }
}

// 6. Event Listeners Interaksi
// Tombol Detail Toggle
btnDetail.addEventListener('click', () => {
  const isExpanded = btnDetail.getAttribute('aria-expanded') === 'true';
  btnDetail.setAttribute('aria-expanded', !isExpanded);
  panelDetail.hidden = isExpanded;
  btnDetail.classList.toggle('is-active');
});

// Fitur Mengganti Tema (Ganti Class Modifikasi)
btnTema.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
});

// Form Tambah Keterampilan Baru dengan Validasi Input Kosong
formSkill.addEventListener('submit', (event) => {
  event.preventDefault();
  const nilaiSkill = inputSkill.value.trim();

  if (nilaiSkill === '') {
    inputSkill.setAttribute('aria-invalid', 'true');
    errorSkill.textContent = 'Nama keterampilan tidak boleh kosong.';
    return;
  }

  inputSkill.setAttribute('aria-invalid', 'false');
  errorSkill.textContent = '';
  
  dataSkills.push(nilaiSkill);
  renderSkills();
  formSkill.reset();
});

// Pemicu Percobaan Ulang Data
btnCobaLagi.addEventListener('click', muatAplikasi);

// Inisialisasi Pertama Kali Aplikasi Dibuka
document.addEventListener('DOMContentLoaded', muatAplikasi);