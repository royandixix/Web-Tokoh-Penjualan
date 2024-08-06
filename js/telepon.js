document.getElementById("telepon").addEventListener("input", function (event) {
    const teleponInput = event.target;
    // Menghapus semua karakter non-digit
    teleponInput.value = teleponInput.value.replace(/\D/g, '');

    // Membatasi panjang input menjadi 12 digit
    if (teleponInput.value.length > 12) {
        teleponInput.value = teleponInput.value.slice(0, 12);
    }
});
