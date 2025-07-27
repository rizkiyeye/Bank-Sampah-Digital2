document.getElementById('formLogin').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("backend/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Login berhasil. Selamat datang, " + data.username);
            window.location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error(err));
});
