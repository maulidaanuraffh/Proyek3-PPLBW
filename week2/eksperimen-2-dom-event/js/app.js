'use strict'; 
  
const judulUtama = document.querySelector('#judul-utama'); 
const status = document.querySelector('#status'); 
const namaInput = document.querySelector('#nama'); 
const jumlahKarakter = document.querySelector('#jumlah-karakter'); 
const tombolUbahJudul = document.querySelector('#ubah-judul'); 
const tombolToggleStatus = document.querySelector('#toggle-status'); 
  
console.log({ 
  judulUtama, 
  status, 
  namaInput, 
  jumlahKarakter, 
  tombolUbahJudul, 
  tombolToggleStatus 
}); 

function ubahStatus(pesan) { 
    if (!status) { 
        console.warn('Elemen #status tidak ditemukan.'); 
        return; 
    } 
    status.textContent = pesan; 
} 

//  ubah judul melalui event click
tombolUbahJudul.addEventListener('click', () => { 
    judulUtama.textContent = 'DOM Berhasil Diubah'; 
    ubahStatus('Teks heading berhasil diubah.'); 
}); 

// ubah class-attribute dan menerapkan style baru
tombolToggleStatus.addEventListener('click', () => { 
    const aktif = document.body.classList.toggle('is-active'); 

    tombolToggleStatus.setAttribute( 
        'aria-pressed', 
        String(aktif) 
    ); 
    
    status.textContent = aktif 
    ? 'Mode aktif dinyalakan.' 
    : 'Mode aktif dimatikan.'; 
}); 

// hitung karakter yang diinput
namaInput.addEventListener('input', (event) => { 
    const jumlah = event.target.value.length; 
    jumlahKarakter.textContent = jumlah; 
});

// Logika FAQ Accordion (Independent Challenge 2)
const tombolFaq = document.querySelectorAll('.accordion-trigger');

tombolFaq.forEach(tombol => {
  tombol.addEventListener('click', function() {
    // Memeriksa status keterbukaan panel saat ini
    const isExpanded = this.getAttribute('aria-expanded') === 'true';
    
    // Mendapatkan elemen panel tujuan berdasarkan nilai atribut aria-controls
    const panelId = this.getAttribute('aria-controls');
    const targetPanel = document.getElementById(panelId);

    // Menutup seluruh panel FAQ lain untuk memastikan hanya satu yang terbuka
    tombolFaq.forEach(otherTombol => {
      if (otherTombol !== tombol) {
        otherTombol.setAttribute('aria-expanded', 'false');
        const otherPanelId = otherTombol.getAttribute('aria-controls');
        document.getElementById(otherPanelId).setAttribute('hidden', '');
      }
    });

    // Mengubah status panel yang diklik ke kondisi sebaliknya
    if (isExpanded) {
      this.setAttribute('aria-expanded', 'false');
      targetPanel.setAttribute('hidden', '');
    } else {
      this.setAttribute('aria-expanded', 'true');
      targetPanel.removeAttribute('hidden');
    }
  });
});