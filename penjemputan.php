<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Layanan Penjemputan Sampah</title>
    <style>
    :root {
        --primary-color: #4caf50;
        --primary-hover: #45a049;
        --secondary-color: #f0f7f0;
        --text-color: #333;
        --light-gray: #f5f5f5;
        --medium-gray: #ddd;
        --dark-gray: #888;
        --success-color: #4caf50;
        --error-color: #f44336;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f9f9f9;
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background-color: var(--primary-color);
        color: white;
        padding: 1rem;
        text-align: center;
        border-radius: 8px 8px 0 0;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .tabs {
        display: flex;
        background-color: white;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .tab {
        padding: 15px 20px;
        cursor: pointer;
        flex: 1;
        text-align: center;
        transition: all 0.3s ease;
        font-weight: 600;
        border-bottom: 3px solid transparent;
    }

    .tab.active {
        background-color: var(--secondary-color);
        border-bottom: 3px solid var(--primary-color);
        color: var(--primary-color);
    }

    .tab:hover:not(.active) {
        background-color: #f5f5f5;
    }

    .tab-content {
        display: none;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        animation: fadeIn 0.5s;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    form {
        display: grid;
        grid-gap: 15px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: var(--text-color);
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px;
        font-size: 16px;
        transition: border 0.3s ease;
    }

    input:focus,
    select:focus,
    textarea:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 12px 20px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: var(--primary-hover);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 15px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .waste-types {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        grid-gap: 15px;
        margin-bottom: 15px;
    }

    .waste-type-card {
        border: 2px solid var(--medium-gray);
        border-radius: 6px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .waste-type-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .waste-type-card.selected {
        border-color: var(--primary-color);
        background-color: var(--secondary-color);
    }

    .waste-type-card i {
        font-size: 2rem;
        margin-bottom: 10px;
        color: var(--dark-gray);
    }

    .waste-type-card.selected i {
        color: var(--primary-color);
    }

    .waste-type-card h3 {
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .time-slots {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        grid-gap: 10px;
        margin-top: 10px;
    }

    .time-slot {
        padding: 10px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .time-slot:hover {
        background-color: var(--light-gray);
    }

    .time-slot.selected {
        background-color: var(--secondary-color);
        border-color: var(--primary-color);
        color: var(--primary-color);
        font-weight: bold;
    }

    .time-slot.disabled {
        background-color: var(--light-gray);
        color: var(--dark-gray);
        cursor: not-allowed;
        text-decoration: line-through;
    }

    .notification {
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-weight: 600;
        display: none;
    }

    .success {
        background-color: #e8f5e9;
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .error {
        background-color: #ffebee;
        color: var(--error-color);
        border-left: 4px solid var(--error-color);
    }

    .pickup-history {
        list-style: none;
    }

    .pickup-item {
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary-color);
        transition: transform 0.3s ease;
    }

    .pickup-item:hover {
        transform: translateX(5px);
    }

    .pickup-item .status {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .status.pending {
        background-color: #fff8e1;
        color: #ff8f00;
    }

    .status.confirmed {
        background-color: #e1f5fe;
        color: #0288d1;
    }

    .status.completed {
        background-color: #e8f5e9;
        color: var(--success-color);
    }

    .status.cancelled {
        background-color: #ffebee;
        color: var(--error-color);
    }

    .pickup-item h3 {
        margin: 5px 0;
        font-size: 1.1rem;
    }

    .pickup-item p {
        color: var(--dark-gray);
        margin: 5px 0;
    }

    .pickup-details {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px dashed var(--medium-gray);
    }

    .pickup-actions {
        margin-top: 10px;
        display: flex;
        gap: 10px;
    }

    .btn-cancel {
        background-color: #f44336;
    }

    .btn-cancel:hover {
        background-color: #e53935;
    }

    .btn-secondary {
        background-color: var(--dark-gray);
    }

    .btn-secondary:hover {
        background-color: #777;
    }

    footer {
        text-align: center;
        padding: 20px;
        color: var(--dark-gray);
        font-size: 0.9rem;
        margin-top: 30px;
    }

    /* Icons replacement with emoji */

    .icon {
        font-size: 24px;
        display: block;
        margin-bottom: 5px;
    }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Layanan Penjemputan Sampah</h1>
            <p>Solusi mudah untuk daur ulang dan pembuangan sampah</p>
        </header>

        <div class="tabs">
            <div class="tab active" data-tab="schedule">Jadwalkan Penjemputan</div>
            <div class="tab" data-tab="history">Riwayat Penjemputan</div>
            <div class="tab" data-tab="info">Informasi</div>
        </div>

        <div id="notification" class="notification"></div>

        <div id="schedule" class="tab-content active">
            <h2>Jadwalkan Penjemputan Sampah</h2>
            <p>
                Silakan isi formulir di bawah ini untuk menjadwalkan penjemputan
                sampah Anda
            </p>
            <br />

            <form id="pickupForm">
                <form action="simpan_penjemputan.php" method="POST">
                    <form action="simpan_setoran.php" method="POST">
                        <div class="form-group">
                            <label>Jenis Sampah</label>
                            <div class="waste-types">
                                <div class="waste-type-card" data-type="organik">
                                    <span class="icon">♻</span>
                                    <h3>Organik</h3>
                                    <p>Sisa makanan, daun, dll</p>
                                </div>
                                <div class="waste-type-card" data-type="anorganik">
                                    <span class="icon">🔋</span>
                                    <h3>Anorganik</h3>
                                    <p>Plastik, kertas, kaca</p>
                                </div>
                                <div class="waste-type-card" data-type="b3">
                                    <span class="icon">⚠</span>
                                    <h3>B3</h3>
                                    <p>Bahan berbahaya</p>
                                </div>
                                <div class="waste-type-card" data-type="elektronik">
                                    <span class="icon">💻</span>
                                    <h3>Elektronik</h3>
                                    <p>Barang elektronik bekas</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="pickupDate">Tanggal Penjemputan</label>
                                <input type="date" id="pickupDate" name="pickupDate" required />
                            </div>

                            <div class="form-group">
                                <label>Waktu Penjemputan</label>
                                <div class="time-slots">
                                    <div class="time-slot" data-time="08:00">08:00</div>
                                    <div class="time-slot" data-time="10:00">10:00</div>
                                    <div class="time-slot" data-time="13:00">13:00</div>
                                    <div class="time-slot" data-time="15:00">15:00</div>
                                    <div class="time-slot disabled" data-time="17:00">
                                        17:00
                                    </div>
                                    <div class="time-slot" data-time="19:00">19:00</div>
                                </div>
                                <input type="hidden" id="pickupTime" name="pickupTime" required />
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" required />
                            </div>

                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <textarea id="address" name="address" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="notes">Catatan Tambahan (opsional)</label>
                            <textarea id="notes" name="notes"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="weight">Perkiraan Berat (kg)</label>
                            <select id="weight" name="weight" required>
                                <option value="">Pilih perkiraan berat</option>
                                <option value="1-5">1-5 kg</option>
                                <option value="6-10">6-10 kg</option>
                                <option value="11-20">11-20 kg</option>
                                <option value="20+">Lebih dari 20 kg</option>
                            </select>
                        </div>

                        <button type="submit">Jadwalkan Penjemputan</button>
                    </form>
                </form>
            </form>
        </div>

        <div id="history" class="tab-content">
            <h2>Riwayat Penjemputan</h2>
            <p>
                Berikut adalah daftar penjemputan sampah yang telah Anda jadwalkan
            </p>
            <br />

            <ul class="pickup-history" id="pickupHistory">
                <!-- Riwayat penjemputan akan ditampilkan di sini -->
            </ul>
        </div>

        <div id="info" class="tab-content">
            <h2>Informasi Layanan Penjemputan Sampah</h2>
            <br />

            <h3>Cara Kerja</h3>
            <ol>
                <li>Isi formulir penjemputan dengan detail yang diperlukan</li>
                <li>Pilih jenis sampah, tanggal, dan waktu penjemputan</li>
                <li>
                    Tim kami akan mengonfirmasi permintaan Anda melalui SMS/telepon
                </li>
                <li>
                    Siapkan sampah Anda sesuai kategori pada waktu yang ditentukan
                </li>
                <li>Tim pengangkut akan datang pada waktu yang dijadwalkan</li>
            </ol>
            <br />

            <h3>Jenis Sampah</h3>
            <ul>
                <li>
                    <strong>Organik:</strong> Sisa makanan, daun, ranting, dan sampah
                    yang dapat terurai
                </li>
                <li>
                    <strong>Anorganik:</strong> Plastik, kertas, kardus, kaca, dan logam
                </li>
                <li>
                    <strong>B3:</strong> Baterai, cat, lampu neon, obat-obatan, dan
                    bahan kimia
                </li>
                <li>
                    <strong>Elektronik:</strong> Perangkat elektronik bekas, kabel, dan
                    aksesori
                </li>
            </ul>
            <br />

            <h3>Pertanyaan Umum</h3>
            <p>
                <strong>Q: Berapa biaya layanan penjemputan?</strong><br />
                A: Biaya layanan bervariasi tergantung jenis dan berat sampah. Untuk
                sampah anorganik daur ulang, kami mungkin membeli dengan harga
                tertentu.
            </p>

            <p>
                <strong>Q: Bagaimana cara membatalkan penjemputan?</strong><br />
                A: Anda dapat membatalkan penjemputan melalui halaman "Riwayat
                Penjemputan" minimal 6 jam sebelum waktu penjemputan.
            </p>

            <p>
                <strong>Q: Di area mana layanan tersedia?</strong><br />
                A: Saat ini kami melayani seluruh wilayah kota dan beberapa kecamatan
                sekitarnya. Cek konfirmasi ketersediaan saat memesan.
            </p>
        </div>

        <footer>
            <p>&copy; 2025 Layanan Penjemputan Sampah. Semua hak dilindungi.</p>
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab Handling
        const tabs = document.querySelectorAll(".tab");
        const tabContents = document.querySelectorAll(".tab-content");

        tabs.forEach((tab) => {
            tab.addEventListener("click", () => {
                const tabId = tab.getAttribute("data-tab");

                // Remove active class from all tabs and contents
                tabs.forEach((t) => t.classList.remove("active"));
                tabContents.forEach((content) => content.classList.remove("active"));

                // Add active class to clicked tab and corresponding content
                tab.classList.add("active");
                document.getElementById(tabId).classList.add("active");

                // Load history if history tab is clicked
                if (tabId === 'history') {
                    loadPickupHistory();
                }
            });
        });

        // Waste Type Selection
        const wasteTypeCards = document.querySelectorAll(".waste-type-card");
        let selectedWasteType = null;

        wasteTypeCards.forEach((card) => {
            card.addEventListener("click", () => {
                wasteTypeCards.forEach((c) => c.classList.remove("selected"));
                card.classList.add("selected");
                selectedWasteType = card.getAttribute("data-type");
                document.querySelector('input[name="waste_type"]').value = selectedWasteType;
            });
        });

        // Time Slot Selection
        const timeSlots = document.querySelectorAll(".time-slot:not(.disabled)");
        const pickupTimeInput = document.getElementById("pickupTime");

        timeSlots.forEach((slot) => {
            slot.addEventListener("click", () => {
                timeSlots.forEach((s) => s.classList.remove("selected"));
                slot.classList.add("selected");
                pickupTimeInput.value = slot.getAttribute("data-time");
            });
        });

        // Form Submission
        const pickupForm = document.getElementById("pickupForm");
        const notification = document.getElementById("notification");

        pickupForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            // Validation
            if (!selectedWasteType) {
                showNotification("Silakan pilih jenis sampah", "error");
                return;
            }

            if (!pickupTimeInput.value) {
                showNotification("Silakan pilih waktu penjemputan", "error");
                return;
            }

            try {
                // Create FormData object from the form
                const formData = new FormData(pickupForm);
                formData.append('waste_type', selectedWasteType);

                // Send data to PHP backend
                const response = await fetch('simpan_penjemputan.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                // First check if response is OK
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(errorText || 'Network response was not ok');
                }

                // Then try to parse as JSON
                const result = await response.json();

                if (result.success) {
                    showNotification(result.message || "Penjemputan berhasil dijadwalkan!",
                        "success");
                    pickupForm.reset();
                    wasteTypeCards.forEach((c) => c.classList.remove("selected"));
                    timeSlots.forEach((s) => s.classList.remove("selected"));
                    selectedWasteType = null;

                    // Update history display
                    loadPickupHistory();
                } else {
                    showNotification(result.message || "Terjadi kesalahan", "error");
                }
            } catch (error) {
                console.error('Error:', error);
                // Handle both JSON and HTML error responses
                try {
                    // Try to parse as JSON in case it's a JSON error message
                    const errorData = JSON.parse(error.message);
                    showNotification(errorData.message || "Terjadi kesalahan", "error");
                } catch (e) {
                    // If not JSON, show raw error message
                    showNotification("Terjadi kesalahan: " + error.message, "error");
                }
            }
        });

        // Load pickup history from server
        async function loadPickupHistory() {
            try {
                const response = await fetch('get_history.php', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                // First check if response is OK
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(errorText || 'Gagal memuat riwayat');
                }

                // Then try to parse as JSON
                const data = await response.json();

                const historyContainer = document.getElementById("pickupHistory");
                historyContainer.innerHTML = "";

                if (!data.success || !data.data || data.data.length === 0) {
                    historyContainer.innerHTML =
                        "<li class='no-history'>Belum ada riwayat penjemputan</li>";
                    return;
                }

                data.data.forEach((pickup) => {
                    const item = document.createElement("li");
                    item.className = "pickup-item";

                    const statusClass = {
                        pending: "pending",
                        confirmed: "confirmed",
                        completed: "completed",
                        cancelled: "cancelled"
                    };

                    const wasteTypeEmoji = {
                        organik: "♻",
                        anorganik: "🔋",
                        b3: "⚠",
                        elektronik: "💻"
                    };

                    item.innerHTML = `
                    <div class="pickup-header">
                        <span class="pickup-date">${formatDate(pickup.pickup_date)} ${pickup.pickup_time}</span>
                        <span class="pickup-status ${statusClass[pickup.status]}">${getStatusText(pickup.status)}</span>
                    </div>
                    <div class="pickup-details">
                        <span class="waste-type ${pickup.waste_type}">${wasteTypeEmoji[pickup.waste_type]} ${getWasteTypeName(pickup.waste_type)}</span>
                        <span class="weight">${pickup.weight_category} kg</span>
                    </div>
                    <div class="pickup-address">${pickup.address}</div>
                    ${pickup.notes ? `<div class="pickup-notes">Catatan: ${pickup.notes}</div>` : ''}
                `;

                    // Add action buttons based on status
                    if (pickup.status === "pending") {
                        const actions = document.createElement("div");
                        actions.className = "pickup-actions";

                        const cancelBtn = document.createElement("button");
                        cancelBtn.className = "btn-cancel";
                        cancelBtn.textContent = "Batalkan";
                        cancelBtn.addEventListener("click", () => cancelPickup(pickup.id));

                        actions.appendChild(cancelBtn);
                        item.appendChild(actions);
                    }

                    historyContainer.appendChild(item);
                });
            } catch (error) {
                console.error('Error loading history:', error);
                const historyContainer = document.getElementById("pickupHistory");
                historyContainer.innerHTML = "<li class='error'>Gagal memuat riwayat: " + error.message +
                    "</li>";
            }
        }

        // Cancel pickup function
        async function cancelPickup(id) {
            try {
                const response = await fetch('cancel_pickup.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                });

                // First check if response is OK
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(errorText || 'Gagal membatalkan penjemputan');
                }

                // Then try to parse as JSON
                const result = await response.json();

                if (result.success) {
                    showNotification(result.message || "Penjemputan berhasil dibatalkan", "success");
                    loadPickupHistory();
                } else {
                    showNotification(result.message || "Gagal membatalkan penjemputan", "error");
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification("Terjadi kesalahan: " + error.message, "error");
            }
        }

        // Helper functions
        function showNotification(message, type) {
            notification.textContent = message;
            notification.className = "notification " + type;
            notification.style.display = "block";

            setTimeout(() => {
                notification.style.display = "none";
            }, 5000);
        }

        function getStatusText(status) {
            const statusTexts = {
                pending: "Menunggu Konfirmasi",
                confirmed: "Terkonfirmasi",
                completed: "Selesai",
                cancelled: "Dibatalkan"
            };
            return statusTexts[status] || status;
        }

        function getWasteTypeName(type) {
            const typeNames = {
                organik: "Sampah Organik",
                anorganik: "Sampah Anorganik",
                b3: "Sampah B3",
                elektronik: "Sampah Elektronik"
            };
            return typeNames[type] || type;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        // Disable past dates in date picker
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("pickupDate").setAttribute("min", today);

        // Initialize the page
        loadPickupHistory();
    });
    </script>
</body>

</html>