function previewImg() {
    const foto = document.querySelector('#foto');
    const imgPreview = document.querySelector('.img-preview');
    const fileFoto = new FileReader();
    fileFoto.readAsDataURL(foto.files[0]);
    fileFoto.onload = function (e) {
        imgPreview.src = e.target.result;
    }
}