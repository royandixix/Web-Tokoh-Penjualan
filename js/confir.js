function confirmEdit(event) {
  if (!confirm("Apakah Anda yakin ingin mengedit item ini?")) {
    event.preventDefault();
  }
}

function confirmDelete(hapus) {
  if (!confirm("Apakah Anda yakin ingin menghapus item ini?")) {
    hapus.preventDefault();
  }
}
