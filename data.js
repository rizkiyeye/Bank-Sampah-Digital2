document
  .getElementById("transferForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const bank = document.getElementById("selectedBank").value;
    const rekening = document.getElementById("bankAccountNumber").value;
    const nama = document.getElementById("bankAccountName").value;
    const jumlah = document.getElementById("transferAmount").value;
    const waktu = document.getElementById("waktuTransfer").value;
    const pesan = document.getElementById("pesan").value;

    fetch("simpan_transfer.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `bank=${encodeURIComponent(bank)}&rekening=${encodeURIComponent(
        rekening
      )}&nama=${encodeURIComponent(nama)}&jumlah=${encodeURIComponent(
        jumlah
      )}&waktu=${encodeURIComponent(waktu)}&pesan=${encodeURIComponent(pesan)}`,
    })
      .then((res) => res.text())
      .then((data) => {
        alert("Transfer berhasil!");
        document.getElementById("transferForm").reset();
      })
      .catch((err) => {
        console.error("Gagal transfer:", err);
      });
  });
