document.getElementById('nama').addEventListener('input', function(event){
    const input = event.target;
    const regex = /^[A-Za-z\s]*$/; // hanya huruf dan spasi yang diperbolehkan
    
    if(!regex.test(input.value)) {
        // Menghapus karakter yang tidak sesuai dari input.value
        input.value = input.value.replace(/[^A-Za-z\s]/g, '');
    }
});
