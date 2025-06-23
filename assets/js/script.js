// File: assets/js/script.js - Untuk Halaman Form (index.php)

document.addEventListener('DOMContentLoaded', function() {

    // BAGIAN 1: MANAJEMEN FIELD DINAMIS
    const counters = { pendidikan: 0, pengalaman: 0, hobi: 0, referensi: 0 };
    function addDynamicItem(type, listElement, templateFunction) {
        if (!listElement) return;
        const index = counters[type];
        const itemHTML = templateFunction(index);
        const div = document.createElement('div');
        div.classList.add('dynamic-item');
        div.innerHTML = itemHTML;
        listElement.appendChild(div);
        setTimeout(() => { div.style.opacity = '1'; div.style.transform = 'translateY(0)'; }, 10);
        counters[type]++;
    }
    const templates = {
        pendidikan: (i) => `<button type="button" class="remove-btn" title="Hapus">&times;</button><input type="text" name="pendidikan[${i}][institusi]" placeholder="Nama Institusi *" required><input type="text" name="pendidikan[${i}][gelar]" placeholder="Gelar / Jurusan *" required><input type="text" name="pendidikan[${i}][tahun]" placeholder="Tahun (contoh: 2020 - 2024) *" required>`,
        pengalaman: (i) => `<button type="button" class="remove-btn" title="Hapus">&times;</button><input type="text" name="pengalaman[${i}][perusahaan]" placeholder="Nama Perusahaan *" required><input type="text" name="pengalaman[${i}][posisi]" placeholder="Posisi / Jabatan *" required><input type="text" name="pengalaman[${i}][tahun]" placeholder="Tahun (contoh: 2022 - Sekarang) *" required>`,
        hobi: (i) => `<button type="button" class="remove-btn" title="Hapus">&times;</button><input type="text" name="hobi[${i}]" placeholder="Masukkan satu hobi" required style="grid-column: 1 / -1;">`,
        referensi: (i) => `<button type="button" class="remove-btn" title="Hapus">&times;</button><input type="text" name="referensi[${i}][nama]" placeholder="Nama Referensi *" required><input type="text" name="referensi[${i}][kontak]" placeholder="Kontak (Email/Telepon) *" required><input type="text" name="referensi[${i}][relasi]" placeholder="Relasi (contoh: Atasan) *" required>`
    };
    document.getElementById('addPendidikan')?.addEventListener('click', () => addDynamicItem('pendidikan', document.getElementById('pendidikan-list'), templates.pendidikan));
    document.getElementById('addPengalaman')?.addEventListener('click', () => addDynamicItem('pengalaman', document.getElementById('pengalaman-list'), templates.pengalaman));
    document.getElementById('addHobi')?.addEventListener('click', () => addDynamicItem('hobi', document.getElementById('hobi-list'), templates.hobi));
    document.getElementById('addReferensi')?.addEventListener('click', () => addDynamicItem('referensi', document.getElementById('referensi-list'), templates.referensi));
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-btn')) {
            const itemToRemove = e.target.closest('.dynamic-item');
            itemToRemove.style.opacity = '0';
            itemToRemove.style.transform = 'scale(0.9)';
            setTimeout(() => { itemToRemove.remove(); }, 300);
        }
    });

    // BAGIAN 2: LIVE PREVIEW & KUSTOMISASI
    const namaInput = document.getElementById('nama_input');
    const previewText = document.getElementById('preview-text');
    const colorPicker = document.getElementById('color-picker');
    const fontPicker = document.getElementById('font-picker');
    namaInput?.addEventListener('input', (e) => { previewText.textContent = e.target.value.trim() || 'Nama Anda'; });
    colorPicker?.addEventListener('change', (e) => { if (e.target.name === 'tema_warna') { previewText.style.color = e.target.value; } });
    fontPicker?.addEventListener('change', (e) => { if (e.target.name === 'font_cv') { previewText.style.fontFamily = e.target.value; } });

    // BAGIAN 3: INTEGRASI AI HELPER
    const generateTentangBtn = document.getElementById('generateTentangBtn');
    const loader = document.getElementById('loader');
    generateTentangBtn?.addEventListener('click', async function() {
        const nama = document.getElementById('nama_input').value;
        const posisi = document.getElementById('posisi_input').value;
        const skillsString = document.getElementById('skills_input').value;
        if (!nama || !posisi || !skillsString) { alert('Mohon isi Nama, Posisi yang dilamar, dan Keahlian untuk hasil AI terbaik.'); return; }
        const skillsArray = skillsString.split(',').map(s => s.trim()).filter(s => s);
        loader.style.display = 'flex';
        try {
            const response = await fetch('ai_helper.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ nama: nama, posisi: posisi, skills: skillsArray }) });
            if (!response.ok) throw new Error(`Gagal menghubungi server: ${response.statusText}`);
            const data = await response.json();
            if (data.success) { document.getElementById('tentang_saya').value = data.text; } else { throw new Error(data.message || 'Terjadi kesalahan dari AI.'); }
        } catch (error) { console.error('Error saat memanggil AI:', error); alert('Terjadi kesalahan: ' + error.message); } finally { loader.style.display = 'none'; }
    });

    // BAGIAN 4: CUSTOM FILE INPUT DENGAN IMAGE PREVIEW
    const fotoInput = document.getElementById('foto_input');
    const fileUploadLabel = document.querySelector('label[for="foto_input"]');
    const fileNameDisplay = document.getElementById('file_name_display');
    const imagePreview = document.getElementById('image_preview');
    fotoInput?.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && fileUploadLabel) {
            fileUploadLabel.querySelector('i').className = 'fas fa-edit';
            fileUploadLabel.querySelector('span').textContent = 'Ganti Foto';
            fileNameDisplay.textContent = 'Foto berhasil dipilih!';
            const reader = new FileReader();
            reader.onload = function(e) { imagePreview.src = e.target.result; imagePreview.classList.add('visible'); }
            reader.readAsDataURL(file);
        } else if (fileUploadLabel) {
            fileUploadLabel.querySelector('i').className = 'fas fa-upload';
            fileUploadLabel.querySelector('span').textContent = 'Pilih Foto...';
            fileNameDisplay.textContent = 'Belum ada file dipilih.';
            imagePreview.classList.remove('visible');
            imagePreview.src = '#';
        }
    });
});