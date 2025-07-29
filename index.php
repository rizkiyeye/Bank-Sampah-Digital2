<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Digital - Kelola Sampah dengan Mudah & Menguntungkan</title>
    <meta name="description"
        content="Bank Sampah Digital membantu Anda mengelola sampah dengan lebih efisien dan mengubahnya menjadi nilai ekonomi.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <img src="panda.jpg" alt="Bank Sampah Digital Logo">
                    <h1>Bank Sampah Digital</h1>
                </div>
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#features">Fitur</a></li>
                    <li><a href="#how-it-works">Cara Kerja</a></li>
                    <li><a href="#categories">Kategori Sampah</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <button class="btn" onclick="window.location.href='login.php'">Masuk</button>
                    <div class="mobile-auth-buttons">
                        <?php if (isset($_SESSION['username'])): ?>
                        <span>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <button class="btn" onclick="logout()">Logout</button>
                        <?php else: ?>
                        <button class="btn" onclick="window.location.href='login.php'">Masuk</button>
                        <button class="btn" id="registerBtnMobile">Daftar</button>
                        <?php endif; ?>
                    </div>
                </ul>


                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h2>Kelola Sampah Dengan Cara Mudah & Menguntungkan</h2>
                    <p>Bank Sampah Digital membantu Anda mengelola sampah dengan lebih efisien dan mengubahnya menjadi
                        nilai ekonomi. Dapatkan pendapatan tambahan dari sampah yang Anda kumpulkan.</p>
                    <div class="hero-buttons">
                        <?php if (isset($_SESSION['username'])): ?>
                        <button class="btn" onclick="window.location.href='penjemputan.php'">Mulai Sekarang</button>
                        <?php else: ?>
                        <button class="btn" id="registerBtnHero">Mulai Sekarang</button>
                        <?php endif; ?>
                        <button class="btn btn-outline">Pelajari Lebih Lanjut</button>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="smph1.jpg" alt="Bank Sampah Digital App">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Fitur Unggulan</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">♻</div>
                    <h3>Penjemputan Sampah</h3>
                    <p>Jadwalkan penjemputan sampah langsung dari rumah Anda dengan mudah melalui aplikasi.</p>
                    <button class="btn" onclick="window.location.href='penjemputan.php'">Mulai Sekarang</button>

                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Tabungan Digital</h3>
                    <p>Dapatkan pembayaran langsung ke tabungan digital Anda setiap kali menyetorkan sampah.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Lacak Setoran</h3>
                    <p>Pantau setoran sampah dan saldo tabungan Anda secara real-time melalui dashboard.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Sistem Reward</h3>
                    <p>Kumpulkan poin dan dapatkan berbagai reward menarik dari partner Bank Sampah Digital.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Akses Mudah</h3>
                    <p>Akses layanan Bank Sampah Digital kapan saja dan di mana saja melalui aplikasi.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Laporan Berkala</h3>
                    <p>Dapatkan laporan berkala tentang kontribusi Anda dalam mengurangi sampah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>Cara Kerja</h2>
            </div>
            <div class="steps">
                <div class="step">
                    <h3>Daftar Akun</h3>
                    <p>Daftar akun Bank Sampah Digital melalui aplikasi atau website dengan mudah dan gratis.</p>
                </div>
                <div class="step">
                    <h3>Pilah Sampah</h3>
                    <p>Pilah sampah sesuai kategori (plastik, kertas, logam, dll) untuk memudahkan proses daur ulang.
                    </p>
                </div>
                <div class="step">
                    <h3>Jadwalkan Penjemputan</h3>
                    <p>Jadwalkan penjemputan sampah melalui aplikasi atau antar langsung ke titik pengumpulan terdekat.
                    </p>
                </div>
                <div class="step">
                    <h3>Dapatkan Pembayaran</h3>
                    <p>Terima pembayaran langsung ke tabungan digital Anda sesuai dengan jenis dan berat sampah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Waste Categories Section -->
    <section class="waste-categories" id="categories">
        <div class="container">
            <div class="section-title">
                <h2>Kategori Sampah & Harga</h2>
            </div>
            <div class="categories-grid" id="kategorisampah">
                <!-- Default categories, akan diganti via JavaScript jika tersambung ke database -->
                <div class="category-card">
                    <div class="category-image">🧴</div>
                    <div class="category-content">
                        <h3>Plastik</h3>
                        <p>Botol plastik, kemasan plastik, kantong plastik, gelas plastik, dll.</p>
                        <div class="category-price">Rp 2.500 - Rp 5.000 / kg</div>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">📰</div>
                    <div class="category-content">
                        <h3>Kertas</h3>
                        <p>Koran, majalah, kardus, buku, kertas HVS, dll.</p>
                        <div class="category-price">Rp 3.000 - Rp 4.500 / kg</div>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">🥫</div>
                    <div class="category-content">
                        <h3>Logam</h3>
                        <p>Kaleng minuman, kaleng makanan, besi, aluminium, dll.</p>
                        <div class="category-price">Rp 8.000 - Rp 15.000 / kg</div>
                    </div>
                </div>
                <div class="category-card">
                    <div class="category-image">🍃</div>
                    <div class="category-content">
                        <h3>Organik</h3>
                        <p>Sampah sisa makanan, sayuran, buah-buahan, dll.</p>
                        <div class="category-price">Rp 1.000 - Rp 2.000 / kg</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Hubungi Kami</h2>
            </div>
            <div class="contact-wrapper">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h3>Alamat</h3>
                            <p>Jl. Lingkungan Hijau No. 123, Jakarta Selatan, Indonesia</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div class="contact-details">
                            <h3>Telepon</h3>
                            <p>+62 812-3456-7890</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>info@banksampahdigital.id</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div class="contact-details">
                            <h3>Jam Operasional</h3>
                            <p>Senin - Sabtu: 08.00 - 17.00</p>
                        </div>
                    </div>
                    <div class="social-media">
                        <h3>Ikuti Kami</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon">📘</a>
                            <a href="#" class="social-icon">📸</a>
                            <a href="#" class="social-icon">🐦</a>
                            <a href="#" class="social-icon">▶️</a>
                        </div>
                    </div>
                </div>
                <div class="contact-form-container">
                    <form class="contact-form" id="contactForm">
                        <h3>Kirim Pesan</h3>
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon Anda">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" name="subject" placeholder="Masukkan subjek pesan">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini" rows="5"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="panda.jpg" alt="Bank Sampah Digital Logo">
                    <h2>Bank Sampah Digital</h2>
                    <p>Solusi modern untuk pengelolaan sampah yang memberikan manfaat ekonomi dan lingkungan.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-links-section">
                        <h3>Navigasi</h3>
                        <ul>
                            <li><a href="#home">Beranda</a></li>
                            <li><a href="#features">Fitur</a></li>
                            <li><a href="#how-it-works">Cara Kerja</a></li>
                            <li><a href="#categories">Kategori Sampah</a></li>
                            <li><a href="#contact">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="footer-links-section">
                        <h3>Layanan</h3>
                        <ul>
                            <li><a href="#">Penjemputan Sampah</a></li>
                            <li><a href="#">Tabungan Digital</a></li>
                            <li><a href="#">Edukasi Lingkungan</a></li>
                            <li><a href="#">Program Komunitas</a></li>
                        </ul>
                    </div>
                    <div class="footer-links-section">
                        <h3>Bantuan</h3>
                        <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Syarat & Ketentuan</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                            <li><a href="#">Panduan Pengguna</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Bank Sampah Digital. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
    // Fungsi untuk logout
    function logout() {
        fetch("backend/logout.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Logout berhasil!");
                    location.reload();
                }
            });
    }

    // Fungsi untuk menampilkan/menyembunyikan modal
    function showModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function hideModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Event listeners untuk tombol modal (jika user belum login)
    <?php if (!isset($_SESSION['username'])): ?>
    document.getElementById('loginBtnMobile')?.addEventListener('click', () => showModal('loginModal'));
    document.getElementById('registerBtnMobile')?.addEventListener('click', () => showModal('registerModal'));
    document.getElementById('registerBtnHero')?.addEventListener('click', () => showModal('registerModal'));
    document.getElementById('registerBtnFeature')?.addEventListener('click', () => showModal('registerModal'));
    <?php endif; ?>

    // Event listeners untuk tombol close modal
    document.querySelectorAll('.close').forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });

    // Menutup modal ketika mengklik di luar modal
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    });

    // Fungsi untuk memuat data kategori sampah
    function loadKategoriSampah() {
        fetch("backend/get_kategori.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById("kategorisampah");
                    let html = "";
                    data.data.forEach(kategori => {
                        html += `
                                <div class="category-card">
                                    <div class="category-image">${kategori.icon || '📦'}</div>
                                    <div class="category-content">
                                        <h3>${kategori.nama_kategori}</h3>
                                        <p>${kategori.deskripsi}</p>
                                        <div class="category-price">Rp ${Number(kategori.harga_per_kg).toLocaleString('id-ID')} / kg</div>
                                    </div>
                                </div>
                            `;
                    });
                    container.innerHTML = html;
                }
            })
            .catch(error => {
                console.error("Error loading kategori:", error);
            });
    }

    // Fungsi untuk memuat data setoran sampah (jika user sudah login)
    function loadDataSampah() {
        fetch("backend/get_setoran.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tbody = document.querySelector("#tabelSampah tbody");
                    let html = "";
                    data.data.forEach(row => {
                        html += `
                                <tr>
                                    <td>${row.jenis_sampah}</td>
                                    <td>${row.berat} kg</td>
                                    <td>Rp ${Number(row.harga_per_kg).toLocaleString('id-ID')}</td>
                                    <td>Rp ${Number(row.total_harga).toLocaleString('id-ID')}</td>
                                    <td>${new Date(row.tanggal).toLocaleDateString('id-ID')}</td>
                                </tr>
                            `;
                    });
                    tbody.innerHTML = html;
                }
            })
            .catch(error => {
                console.error("Error loading data sampah:", error);
            });
    }

    // Fungsi untuk memuat notifikasi
    function loadNotifikasi() {
        fetch("backend/get_notifikasi.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let html = "";
                    data.data.forEach(notif => {
                        html += `
                                <li>
                                    ${notif.pesan}
                                    <br><small>${new Date(notif.tanggal).toLocaleDateString('id-ID')}</small>
                                </li>
                            `;
                    });
                    document.getElementById("notifikasi").innerHTML = html;
                }
            })
            .catch(error => {
                console.error("Error loading notifikasi:", error);
            });
    }

    // Handle form registrasi
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("backend/register.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Registrasi berhasil! Silakan login.");
                    this.reset();
                    hideModal('registerModal');
                    showModal('loginModal');
                } else {
                    alert("Gagal registrasi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Terjadi kesalahan sistem");
            });
    });

    // Handle form login
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("backend/login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Login berhasil!");
                    location.reload(); // Reload halaman untuk update tampilan
                } else {
                    alert("Login gagal: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Terjadi kesalahan sistem");
            });
    });

    // Handle form kontak
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("backend/simpan_pesan.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Pesan berhasil dikirim!");
                    this.reset();
                } else {
                    alert("Gagal mengirim pesan: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Terjadi kesalahan sistem");
            });
    });

    // Load data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        loadKategoriSampah();

        <?php if (isset($_SESSION['username'])): ?>
        // Jika user sudah login, load data tambahan
        loadDataSampah();
        loadNotifikasi();
        <?php endif; ?>
    });

    // Hamburger menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    hamburger?.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
    </script>
</body>

</html>