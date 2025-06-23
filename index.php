<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Resume Generator - Buat CV Anda</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet">
</head>
<body>

    <div id="loader" class="loader-overlay" style="display:none;">
        <div class="loader-spinner"></div>
        <p>AI sedang menulis...</p>
    </div>

    <header class="main-header">
        <div class="header-content">
            <i class="fa-solid fa-file-signature header-icon" aria-hidden="true"></i>
            <div>
                <h1>AI Resume Generator</h1>
                <p>Isi data di bawah ini untuk membuat CV profesional secara otomatis.</p>
            </div>
        </div>
    </header>

    <main>
        <form id="resumeForm" action="generate.php" method="POST" autocomplete="off" enctype="multipart/form-data">
            <section class="form-section">
                <h2><i class="fa-solid fa-user"></i> Data Pribadi</h2>
                <div class="input-group">
                    <label>Nama Lengkap <span class="wajib">*</span>
                        <input type="text" id="nama_input" name="nama" placeholder="Contoh: Budi Santoso" required>
                    </label>
                    <label>Posisi yang Dilamar <span class="wajib">*</span>
                        <input type="text" id="posisi_input" name="posisi" placeholder="Contoh: Junior Web Developer" required>
                    </label>
                </div>
                <div class="input-group">
                    <label>Tempat, Tanggal Lahir
                        <input type="text" name="ttl" placeholder="Contoh: Yogyakarta, 17 Agustus 1999">
                    </label>
                    <label>Jenis Kelamin
                        <select name="jk">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </label>
                </div>
                <label>Alamat
                    <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap Anda"></textarea>
                </label>
                <div class="input-group">
                    <label>No. Telepon <span class="wajib">*</span>
                        <input type="tel" name="telepon" placeholder="Contoh: 081234567890" required>
                    </label>
                    <label>Email <span class="wajib">*</span>
                        <input type="email" name="email" placeholder="Contoh: budi.santoso@email.com" required>
                    </label>
                </div>
                <div class="input-group">
                    <label>Profil LinkedIn (Opsional)
                        <input type="text" name="linkedin" placeholder="https://www.linkedin.com/in/namaanda">
                    </label>
                    <label>Foto Profil (Opsional)
                        <div class="file-upload-wrapper">
                            <input type="file" name="foto" id="foto_input" class="file-input-hidden" accept="image/png, image/jpeg">
                            <label for="foto_input" class="file-upload-label">
                                <i class="fas fa-upload"></i>
                                <span>Pilih Foto...</span>
                            </label>
                            <div class="file-info-wrapper">
                                <span id="file_name_display" class="file-name">Belum ada file dipilih.</span>
                                <img id="image_preview" class="image-preview" src="#" alt="Preview Foto">
                            </div>
                        </div>
                    </label>
                </div>
            </section>

            <section class="form-section">
                <h2><i class="fa-solid fa-info-circle"></i> Tentang Saya</h2>
                <div class="ai-helper">
                    <textarea name="tentang" id="tentang_saya" rows="5" placeholder="Tuliskan ringkasan singkat tentang diri Anda, atau biarkan AI membantu..."></textarea>
                    <button type="button" class="ai-btn" id="generateTentangBtn" title="Buat 'Tentang Saya' dengan AI">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Buat dengan AI
                    </button>
                </div>
            </section>

            <section class="form-section">
                <h2><i class="fa-solid fa-graduation-cap"></i> Riwayat Pendidikan</h2>
                <div id="pendidikan-list"></div>
                <button type="button" class="add-btn" id="addPendidikan"><i class="fa-solid fa-plus"></i> Tambah Pendidikan</button>
            </section>

            <section class="form-section">
                <h2><i class="fa-solid fa-briefcase"></i> Pengalaman Kerja</h2>
                <div id="pengalaman-list"></div>
                <button type="button" class="add-btn" id="addPengalaman"><i class="fa-solid fa-plus"></i> Tambah Pengalaman</button>
            </section>

            <section class="form-section">
                <h2><i class="fa-solid fa-tools"></i> Keahlian</h2>
                <label>Sebutkan keahlian Anda, pisahkan dengan koma.
                    <input type="text" id="skills_input" name="skills" placeholder="Contoh: PHP, JavaScript, Problem Solving, Komunikasi" required>
                </label>
            </section>

            <section class="form-section">
                <h2><i class="fas fa-heart"></i> Hobi</h2>
                <div id="hobi-list"></div>
                <button type="button" class="add-btn" id="addHobi"><i class="fa-solid fa-plus"></i> Tambah Hobi</button>
            </section>

            <section class="form-section">
                <h2><i class="fas fa-address-card"></i> Referensi</h2>
                <div id="referensi-list"></div>
                <button type="button" class="add-btn" id="addReferensi"><i class="fa-solid fa-plus"></i> Tambah Referensi</button>
            </section>

            <section class="form-section">
                <h2><i class="fa-solid fa-palette"></i> Kustomisasi Tampilan</h2>
                <div class="custom-cv-options">
                    <label>
                        <span><i class="fa-solid fa-droplet"></i> Warna Tema</span>
                        <div class="color-options" id="color-picker">
                            <label class="color-radio" style="--color:#2563eb;"><input type="radio" name="tema_warna" value="#2563eb" checked><span class="color-circle"></span></label>
                            <label class="color-radio" style="--color:#16a34a;"><input type="radio" name="tema_warna" value="#16a34a"><span class="color-circle"></span></label>
                            <label class="color-radio" style="--color:#ca8a04;"><input type="radio" name="tema_warna" value="#ca8a04"><span class="color-circle"></span></label>
                            <label class="color-radio" style="--color:#dc2626;"><input type="radio" name="tema_warna" value="#dc2626"><span class="color-circle"></span></label>
                            <label class="color-radio" style="--color:#4f46e5;"><input type="radio" name="tema_warna" value="#4f46e5"><span class="color-circle"></span></label>
                        </div>
                    </label>
                    <label>
                        <span><i class="fa-solid fa-font"></i> Pilih Font</span>
                        <div class="font-options" id="font-picker">
                            <label class="font-radio" style="font-family:'Poppins', sans-serif;"><input type="radio" name="font_cv" value="'Poppins', sans-serif" checked><span>Poppins</span></label>
                            <label class="font-radio" style="font-family:'Roboto', sans-serif;"><input type="radio" name="font_cv" value="'Roboto', sans-serif"><span>Roboto</span></label>
                            <label class="font-radio" style="font-family:'Segoe UI',Arial,sans-serif;"><input type="radio" name="font_cv" value="'Segoe UI',Arial,sans-serif"><span>Segoe UI</span></label>
                            <label class="font-radio" style="font-family:'Times New Roman',serif;"><input type="radio" name="font_cv" value="'Times New Roman',serif"><span>Times New Roman</span></label>
                        </div>
                    </label>
                </div>
                <div class="cv-preview">
                    <span class="preview-label">Live Preview Nama:</span>
                    <span id="preview-text" style="color:#2563eb; font-family:'Poppins', sans-serif;">Nama Anda</span>
                </div>
            </section>

            <button type="submit" class="submit-btn"><i class="fa-solid fa-paper-plane"></i> Buat CV Sekarang</button>
        </form>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> AI Resume Generator. Dibuat dengan <i class="fa-solid fa-heart" style="color: #dc2626;"></i> di Yogyakarta.</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>