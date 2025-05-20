<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Digital</title>
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #81c784;
            --text-color: #333;
            --bg-color: #f5f5f5;
            --card-color: #fff;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --danger-color: #e53935;
        }

        .dark-mode {
            --primary-color: #81c784;
            --secondary-color: #2e7d32;
            --text-color: #f5f5f5;
            --bg-color: #121212;
            --card-color: #1e1e1e;
            --shadow-color: rgba(255, 255, 255, 0.05);
            --danger-color: #ef5350;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--secondary-color);
        }

        h1 {
            color: var(--primary-color);
        }

        .theme-toggle {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .theme-toggle:hover {
            background-color: var(--secondary-color);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background-color: var(--card-color);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px var(--shadow-color);
            margin-bottom: 20px;
        }

        .card h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: var(--card-color);
            color: var(--text-color);
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-danger {
            background-color: var(--danger-color);
        }

        button:hover {
            opacity: 0.9;
        }

        .transaction-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-type {
            font-weight: 500;
        }

        .transaction-amount {
            font-weight: bold;
        }

        .transaction-amount.income {
            color: var(--primary-color);
        }

        .transaction-amount.outcome {
            color: var(--danger-color);
        }

        .transaction-date {
            font-size: 0.8em;
            color: #777;
        }

        .saldo {
            text-align: center;
            margin: 20px 0;
        }

        .saldo h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .saldo p {
            font-size: 2em;
            font-weight: bold;
            color: var(--primary-color);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 6px var(--shadow-color);
            transform: translateX(200%);
            transition: transform 0.3s;
            z-index: 1000;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.error {
            background-color: var(--danger-color);
        }

        .tabs {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            border-bottom: 3px solid var(--primary-color);
            font-weight: 500;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .bank-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin: 15px 0;
        }

        .bank-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .bank-item:hover, .bank-item.selected {
            border-color: var(--primary-color);
            background-color: rgba(46, 125, 50, 0.1);
        }

        .bank-item img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-bottom: 5px;
        }

        .bank-item p {
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bank Sampah Digital</h1>
            <button id="themeToggle" class="theme-toggle">
                <span id="themeIcon">🌙</span> Mode Malam
            </button>
        </header>

        <div class="saldo">
            <h3>Saldo Anda</h3>
            <p id="saldoAmount">Rp 0</p>
        </div>

        <div class="main-content">
            <div>
                <div class="card">
                    <div class="tabs">
                        <div class="tab active" data-tab="deposit">Setor Sampah</div>
                        <div class="tab" data-tab="transfer">Transfer Bank</div>
                    </div>

                    <div id="depositTab" class="tab-content active">
                        <form id="depositForm">
                            <div class="form-group">
                                <label for="jenisSampah">Jenis Sampah</label>
                                <select id="jenisSampah" required>
                                    <option value="">Pilih Jenis Sampah</option>
                                    <option value="plastik">Plastik</option>
                                    <option value="kertas">Kertas</option>
                                    <option value="kaleng">Kaleng</option>
                                    <option value="kaca">Kaca</option>
                                    <option value="organik">Organik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="beratSampah">Berat (kg)</label>
                                <input type="number" id="beratSampah" step="0.1" min="0.1" required>
                            </div>
                            <div class="form-group">
                                <label for="hargaPerKg">Harga per kg (Rp)</label>
                                <input type="number" id="hargaPerKg" required>
                            </div>
                            <button type="submit">Setor Sampah</button>
                        </form>
                    </div>

                    <div id="transferTab" class="tab-content">
                        <form id="transferForm">
                            <div class="form-group">
                                <label>Pilih Bank Tujuan</label>
                                <div class="bank-list" id="bankList">
                                    <!-- Bank items will be added here by JavaScript -->
                                </div>
                                <input type="hidden" id="selectedBank" required>
                            </div>
                            <div class="form-group">
                                <label for="bankAccountNumber">Nomor Rekening</label>
                                <input type="text" id="bankAccountNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="bankAccountName">Nama Pemilik Rekening</label>
                                <input type="text" id="bankAccountName" required>
                            </div>
                            <div class="form-group">
                                <label for="transferAmount">Jumlah Transfer (Rp)</label>
                                <input type="number" id="transferAmount" min="10000" required>
                            </div>
                            <button type="submit" class="btn-danger">Transfer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <h2>Riwayat Transaksi</h2>
                    <div id="transactionHistory">
                        <p>Belum ada transaksi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="notification" id="notification">
        Transaksi berhasil dicatat!
    </div>

    <script>
        // Data awal
        let saldo = 0;
        let transactions = [];
        let isDarkMode = false;
        let selectedBank = null;

        // Daftar bank
        const banks = [
            { code: 'bca', name: 'BCA', logo: 'https://logo.clearbit.com/bca.co.id' },
            { code: 'bri', name: 'BRI', logo: 'https://logo.clearbit.com/bri.co.id' },
            { code: 'mandiri', name: 'Mandiri', logo: 'https://logo.clearbit.com/bankmandiri.co.id' },
            { code: 'bni', name: 'BNI', logo: 'https://logo.clearbit.com/bni.co.id' },
            { code: 'btn', name: 'BTN', logo: 'https://logo.clearbit.com/btn.co.id' },
            { code: 'cimb', name: 'CIMB Niaga', logo: 'https://logo.clearbit.com/cimbniaga.co.id' },
            { code: 'danamon', name: 'Danamon', logo: 'https://logo.clearbit.com/danamon.co.id' },
            { code: 'permata', name: 'Permata', logo: 'https://logo.clearbit.com/permatabank.com' }
        ];

        // DOM Elements
        const depositForm = document.getElementById('depositForm');
        const transferForm = document.getElementById('transferForm');
        const transactionHistory = document.getElementById('transactionHistory');
        const saldoAmount = document.getElementById('saldoAmount');
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const notification = document.getElementById('notification');
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        const bankList = document.getElementById('bankList');
        const selectedBankInput = document.getElementById('selectedBank');

        // Harga default per kg untuk setiap jenis sampah
        const hargaSampah = {
            plastik: 3000,
            kertas: 2000,
            kaleng: 5000,
            kaca: 4000,
            organik: 1000
        };

        // Inisialisasi
        document.addEventListener('DOMContentLoaded', () => {
            loadData();
            updateSaldoDisplay();
            updateTransactionHistory();
            renderBankList();

            // Set event listener untuk perubahan jenis sampah
            document.getElementById('jenisSampah').addEventListener('change', function() {
                const jenis = this.value;
                if (jenis && hargaSampah[jenis]) {
                    document.getElementById('hargaPerKg').value = hargaSampah[jenis];
                } else {
                    document.getElementById('hargaPerKg').value = '';
                }
            });

            // Tab navigation
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    tab.classList.add('active');
                    document.getElementById(`${tab.dataset.tab}Tab`).classList.add('active');
                });
            });
        });

        // Form submission setor sampah
        depositForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const jenisSampah = document.getElementById('jenisSampah').value;
            const berat = parseFloat(document.getElementById('beratSampah').value);
            const hargaPerKg = parseInt(document.getElementById('hargaPerKg').value);
            
            const total = berat * hargaPerKg;
            
            // Tambahkan ke saldo
            saldo += total;
            
            // Catat transaksi
            const transaction = {
                id: Date.now(),
                type: 'deposit',
                jenis: jenisSampah,
                berat: berat,
                hargaPerKg: hargaPerKg,
                total: total,
                tanggal: new Date().toLocaleString()
            };
            
            transactions.unshift(transaction);
            
            // Update tampilan
            updateSaldoDisplay();
            updateTransactionHistory();
            showNotification('Setor sampah berhasil!');
            
            // Simpan data
            saveData();
            
            // Reset form
            this.reset();
        });

        // Form submission transfer bank
        transferForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const bankCode = selectedBankInput.value;
            const bankName = banks.find(b => b.code === bankCode)?.name || 'Bank';
            const accountNumber = document.getElementById('bankAccountNumber').value;
            const accountName = document.getElementById('bankAccountName').value;
            const amount = parseInt(document.getElementById('transferAmount').value);
            
            // Validasi saldo cukup
            if (amount > saldo) {
                showNotification('Saldo tidak mencukupi!', true);
                return;
            }
            
            // Kurangi saldo
            saldo -= amount;
            
            // Catat transaksi
            const transaction = {
                id: Date.now(),
                type: 'transfer',
                bank: bankName,
                accountNumber: accountNumber,
                accountName: accountName,
                total: amount,
                tanggal: new Date().toLocaleString()
            };
            
            transactions.unshift(transaction);
            
            // Update tampilan
            updateSaldoDisplay();
            updateTransactionHistory();
            showNotification(`Transfer ke ${bankName} berhasil!`);
            
            // Simpan data
            saveData();
            
            // Reset form
            this.reset();
            selectedBank = null;
            updateBankSelection();
        });

        // Fungsi untuk render daftar bank
        function renderBankList() {
            bankList.innerHTML = '';
            banks.forEach(bank => {
                const bankItem = document.createElement('div');
                bankItem.className = 'bank-item';
                bankItem.dataset.code = bank.code;
                bankItem.innerHTML = `
                    <img src="${bank.logo}" alt="${bank.name}" onerror="this.src='https://via.placeholder.com/40'">
                    <p>${bank.name}</p>
                `;
                bankItem.addEventListener('click', () => {
                    selectedBank = bank.code;
                    selectedBankInput.value = bank.code;
                    updateBankSelection();
                });
                bankList.appendChild(bankItem);
            });
        }

        // Fungsi untuk update tampilan bank yang dipilih
        function updateBankSelection() {
            document.querySelectorAll('.bank-item').forEach(item => {
                item.classList.remove('selected');
                if (item.dataset.code === selectedBank) {
                    item.classList.add('selected');
                }
            });
        }

        // Fungsi untuk update tampilan saldo
        function updateSaldoDisplay() {
            saldoAmount.textContent = `Rp ${saldo.toLocaleString('id-ID')}`;
        }

        // Fungsi untuk update riwayat transaksi
        function updateTransactionHistory() {
            if (transactions.length === 0) {
                transactionHistory.innerHTML = '<p>Belum ada transaksi</p>';
                return;
            }
            
            let html = '';
            transactions.forEach(trans => {
                if (trans.type === 'deposit') {
                    html += `
                        <div class="transaction-item">
                            <div>
                                <span class="transaction-type">Setor ${capitalizeFirstLetter(trans.jenis)}</span>
                                <span class="transaction-date">${trans.tanggal}</span>
                            </div>
                            <div>
                                <span class="transaction-amount income">+Rp ${trans.total.toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    `;
                } else if (trans.type === 'transfer') {
                    html += `
                        <div class="transaction-item">
                            <div>
                                <span class="transaction-type">Transfer ke ${trans.bank} (${trans.accountNumber})</span>
                                <span class="transaction-date">${trans.tanggal}</span>
                            </div>
                            <div>
                                <span class="transaction-amount outcome">-Rp ${trans.total.toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    `;
                }
            });
            
            transactionHistory.innerHTML = html;
        }

        // Fungsi helper untuk kapitalisasi huruf pertama
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message = 'Transaksi berhasil dicatat!', isError = false) {
            notification.textContent = message;
            notification.classList.toggle('error', isError);
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Fungsi untuk toggle mode malam
        themeToggle.addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            document.body.classList.toggle('dark-mode', isDarkMode);
            
            if (isDarkMode) {
                themeIcon.textContent = '☀️';
                themeToggle.innerHTML = '<span id="themeIcon">☀️</span> Mode Siang';
            } else {
                themeIcon.textContent = '🌙';
                themeToggle.innerHTML = '<span id="themeIcon">🌙</span> Mode Malam';
            }
            
            saveData();
        });

        // Fungsi untuk menyimpan data ke localStorage
        function saveData() {
            const data = {
                saldo: saldo,
                transactions: transactions,
                isDarkMode: isDarkMode
            };
            localStorage.setItem('bankSampahData', JSON.stringify(data));
        }

        // Fungsi untuk memuat data dari localStorage
        function loadData() {
            const savedData = localStorage.getItem('bankSampahData');
            if (savedData) {
                const data = JSON.parse(savedData);
                saldo = data.saldo || 0;
                transactions = data.transactions || [];
                isDarkMode = data.isDarkMode || false;
                
                // Apply dark mode if enabled
                if (isDarkMode) {
                    document.body.classList.add('dark-mode');
                    themeIcon.textContent = '☀️';
                    themeToggle.innerHTML = '<span id="themeIcon">☀️</span> Mode Siang';
                }
            }
        }
    </script>
</body>
</html>