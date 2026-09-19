'use strict';

// ==========================================
// 1. DATA STATE INTERNAL (Divisi Tetap)
// ==========================================
const dataDivisi = [
  { id: 1, judul: 'Bahasa',   kategori: 'Teori',   deskripsi: 'Belajar undak-usuk basa: penggunaan ragam bahasa loma untuk teman sebaya dan ragam lemes untuk orang tua secara tepat.' },
  { id: 2, judul: 'Aksara',   kategori: 'Teori',   deskripsi: 'Menguasai huruf ngalagena, rarangkén, dan angka. Target utama: mampu menuliskan nama sendiri tanpa bantuan tabel.' },
  { id: 3, judul: 'Kesenian', kategori: 'Praktik', deskripsi: 'Latihan langsung musik tradisional kacapi suling dan seni tembang Cianjuran menggunakan alat musik yang telah disediakan.' },
  { id: 4, judul: 'Budaya',   kategori: 'Praktik', deskripsi: 'Diskusi interaktif mengenai filosofi kampung adat, upacara adat tradisional, serta pendalaman prinsip silih asih, asah, dan asuh.' }
];

// ==========================================
// 2. SELEKTOR ELEMEN DOM
// ==========================================
const statusAplikasi     = document.querySelector('#status-aplikasi');
const btnCobaLagi        = document.querySelector('#btn-coba-lagi');
const cardListContainer  = document.querySelector('.card-list');
const testimoniContainer = document.querySelector('#kontainer-testimoni');
const filterKategori     = document.querySelector('#filter-kategori');

const btnNavToggle  = document.querySelector('#nav-toggle');
const navList       = document.querySelector('.nav-list');
const faqTriggers   = document.querySelectorAll('.accordion-trigger');
const formKontak    = document.querySelector('#form-pendaftaran');
const btnBackToTop  = document.querySelector('#back-to-top');
const btnUbahTema   = document.querySelector('#ubah-tema');

// State khusus testimoni async
let dataMasterTestimoni = [];
let sedangMemuat = false;

// ==========================================
// 3. FUNGSI UTILITAS STATE
// ==========================================
function aturState(state, pesan) {
  if (!statusAplikasi) return;
  statusAplikasi.dataset.state = state;
  statusAplikasi.textContent = pesan;
  if (btnCobaLagi) {
    btnCobaLagi.hidden = (state !== 'error');
  }
}

// ==========================================
// 4. PEMBUAT KOMPONEN DOM
// ==========================================

// Kartu divisi — dari data lokal
function buatKartuDivisi(item) {
  const article = document.createElement('article');
  article.classList.add('card');
  article.setAttribute('role', 'listitem');

  const h3 = document.createElement('h3');
  h3.textContent = item.judul;

  const spanKategori = document.createElement('span');
  spanKategori.classList.add('badge-kategori');
  spanKategori.textContent = item.kategori;

  const p = document.createElement('p');
  p.textContent = item.deskripsi;

  article.append(h3, spanKategori, p);
  return article;
}

// Kartu testimoni — dari data async JSON
function buatKartuTestimoni(item) {
  const divItem = document.createElement('div');
  divItem.classList.add('testimoni-item');

  const figure = document.createElement('figure');
  figure.classList.add('cerita-foto');

  const img = document.createElement('img');
  img.src = item.foto;
  img.alt = `Foto ${item.nama}`;

  figure.append(img);

  const blockquote = document.createElement('blockquote');
  blockquote.classList.add('kutipan');

  const pTeks = document.createElement('p');
  pTeks.textContent = `"${item.teks}"`;

  const footer = document.createElement('footer');
  const keterangan = item.angkatan || item.jurusan || item.prodi || '';
  footer.textContent = keterangan
    ? `— ${item.nama}, ${keterangan}`
    : `— ${item.nama}`;

  blockquote.append(pTeks, footer);
  divItem.append(figure, blockquote);

  return divItem;
}

// ==========================================
// 5. FUNGSI RENDER
// ==========================================
function renderDivisi(daftarData) {
  if (!cardListContainer) return;
  cardListContainer.replaceChildren();

  if (daftarData.length === 0) {
    const pesanKosong = document.createElement('p');
    pesanKosong.classList.add('pesan-kosong');
    pesanKosong.textContent = 'Tidak ada divisi ditemukan untuk kategori ini.';
    cardListContainer.append(pesanKosong);
    return;
  }

  daftarData.forEach(item => {
    cardListContainer.append(buatKartuDivisi(item));
  });
}

function renderTestimoni(daftarData) {
  if (!testimoniContainer) return;
  testimoniContainer.replaceChildren();

  if (daftarData.length === 0) {
    aturState('empty', 'Belum ada cerita anggota.');
    return;
  }

  daftarData.forEach(item => {
    testimoniContainer.append(buatKartuTestimoni(item));
  });
}

// ==========================================
// 6. ASYNC: FETCH TESTIMONI
// ==========================================
async function ambilDataTestimoni() {
  const response = await fetch('data/testimoni.json');
  if (!response.ok) {
    throw new Error(`Berkas testimoni gagal diakses (HTTP ${response.status})`);
  }
  return response.json();
}

async function muatTestimoniAsinkron() {
  if (sedangMemuat) return;
  sedangMemuat = true;

  aturState('loading', 'Memuat cerita anggota...');

  try {
    const data = await ambilDataTestimoni();
    dataMasterTestimoni = Array.isArray(data) ? data : [];

    renderTestimoni(dataMasterTestimoni);
    if (dataMasterTestimoni.length > 0) {
      aturState('success', `${dataMasterTestimoni.length} cerita anggota ditampilkan.`);
    }
  } catch (error) {
    console.error('Gagal memuat testimoni:', error);
    aturState('error', `Gagal memuat cerita: ${error.message}`);
  } finally {
    sedangMemuat = false;
  }
}

// ==========================================
// 7. EVENT LISTENERS
// ==========================================

// --- Navigasi mobile hamburger ---
if (btnNavToggle && navList) {
  btnNavToggle.addEventListener('click', () => {
    const isExpanded = btnNavToggle.getAttribute('aria-expanded') === 'true';
    btnNavToggle.setAttribute('aria-expanded', String(!isExpanded));
    navList.classList.toggle('is-open');
  });
}

// --- Filter kategori divisi ---
if (filterKategori) {
  filterKategori.addEventListener('change', () => {
    const nilaiFilter = filterKategori.value;
    if (nilaiFilter === 'Semua') {
      renderDivisi(dataDivisi);
    } else {
      const hasilFilter = dataDivisi.filter(item => item.kategori === nilaiFilter);
      renderDivisi(hasilFilter);
    }
  });
}

// --- FAQ accordion (hanya satu panel terbuka) ---
faqTriggers.forEach(trigger => {
  trigger.addEventListener('click', function () {
    const isExpanded = this.getAttribute('aria-expanded') === 'true';
    const panelTargetId = this.getAttribute('aria-controls');
    const panelTarget = document.getElementById(panelTargetId);

    // Tutup semua panel lain
    faqTriggers.forEach(otherTrigger => {
      if (otherTrigger !== trigger) {
        otherTrigger.setAttribute('aria-expanded', 'false');
        const otherPanelId = otherTrigger.getAttribute('aria-controls');
        const otherPanel = document.getElementById(otherPanelId);
        if (otherPanel) otherPanel.setAttribute('hidden', '');
      }
    });

    // Toggle panel yang diklik
    if (isExpanded) {
      this.setAttribute('aria-expanded', 'false');
      if (panelTarget) panelTarget.setAttribute('hidden', '');
    } else {
      this.setAttribute('aria-expanded', 'true');
      if (panelTarget) panelTarget.removeAttribute('hidden');
    }
  });
});

// --- Validasi form pendaftaran ---
if (formKontak) {
  formKontak.addEventListener('submit', (event) => {
    event.preventDefault();
    let statusValid = true;

    const inputNama    = document.querySelector('#input-nama');
    const inputJurusan = document.querySelector('#input-jurusan');
    const inputDivisi  = document.querySelector('#input-divisi');
    const inputKontak  = document.querySelector('#input-kontak');
    const errorNama    = document.querySelector('#error-nama');
    const errorJurusan = document.querySelector('#error-jurusan');
    const errorDivisi  = document.querySelector('#error-divisi');
    const errorKontak  = document.querySelector('#error-kontak');

    // Reset semua state error
    [inputNama, inputJurusan, inputDivisi, inputKontak].forEach(el => {
      el.setAttribute('aria-invalid', 'false');
    });
    [errorNama, errorJurusan, errorDivisi, errorKontak].forEach(el => {
      el.textContent = '';
    });

    // Validasi nama — wajib, minimal 3 karakter
    const nilaiNama = inputNama.value.trim();
    if (nilaiNama === '') {
      inputNama.setAttribute('aria-invalid', 'true');
      errorNama.textContent = 'Nama lengkap wajib diisi.';
      statusValid = false;
    } else if (nilaiNama.length < 3) {
      inputNama.setAttribute('aria-invalid', 'true');
      errorNama.textContent = 'Nama minimal 3 karakter.';
      statusValid = false;
    }

    // Validasi jurusan — wajib, minimal 3 karakter
    const nilaiJurusan = inputJurusan.value.trim();
    if (nilaiJurusan === '') {
      inputJurusan.setAttribute('aria-invalid', 'true');
      errorJurusan.textContent = 'Jurusan wajib diisi.';
      statusValid = false;
    } else if (nilaiJurusan.length < 3) {
      inputJurusan.setAttribute('aria-invalid', 'true');
      errorJurusan.textContent = 'Jurusan minimal 3 karakter.';
      statusValid = false;
    }

    // Validasi divisi — wajib dipilih
    const nilaiDivisi = inputDivisi.value;
    if (nilaiDivisi === '') {
      inputDivisi.setAttribute('aria-invalid', 'true');
      errorDivisi.textContent = 'Divisi wajib dipilih.';
      statusValid = false;
    }

    // Validasi kontak — wajib, harus no HP (10-13 digit) atau email (memuat @)
    const nilaiKontak = inputKontak.value.trim();
    if (nilaiKontak === '') {
      inputKontak.setAttribute('aria-invalid', 'true');
      errorKontak.textContent = 'No. HP atau email wajib diisi.';
      statusValid = false;
    } else {
      const adalahAngka = /^\d+$/.test(nilaiKontak);
      const adalahEmail = nilaiKontak.includes('@');
      if (adalahAngka && (nilaiKontak.length < 10 || nilaiKontak.length > 13)) {
        inputKontak.setAttribute('aria-invalid', 'true');
        errorKontak.textContent = 'No. HP harus 10–13 digit.';
        statusValid = false;
      } else if (!adalahAngka && !adalahEmail) {
        inputKontak.setAttribute('aria-invalid', 'true');
        errorKontak.textContent = 'Masukkan no. HP (angka) atau email (memuat @).';
        statusValid = false;
      }
    }

    if (statusValid) {
      alert(
        `Pendaftaran berhasil!\n\n` +
        `Nama: ${nilaiNama}\n` +
        `Jurusan: ${nilaiJurusan}\n` +
        `Divisi: ${nilaiDivisi}\n` +
        `Kontak: ${nilaiKontak}`
      );
      formKontak.reset();
    }
  });
}

// --- Back to top ---
if (btnBackToTop) {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      btnBackToTop.classList.add('visible');
    } else {
      btnBackToTop.classList.remove('visible');
    }
  });

  btnBackToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// --- Ubah tema (dark mode) ---
if (btnUbahTema) {
  btnUbahTema.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');
    const isDark = document.body.classList.contains('dark-theme');
    btnUbahTema.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';
  });
}

// --- Coba lagi (retry testimoni) ---
if (btnCobaLagi) {
  btnCobaLagi.addEventListener('click', muatTestimoniAsinkron);
}

// ==========================================
// 8. INISIALISASI
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
  renderDivisi(dataDivisi);
  muatTestimoniAsinkron();
});