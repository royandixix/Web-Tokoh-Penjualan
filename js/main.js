// Pastikan seluruh konten halaman sudah dimuat
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi DataTables
    const table = document.querySelector('#example');
    if (table) {
        new DataTable(table, {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            searchable: true,
            sortable: true,
            labels: {
                placeholder: "Cari...",
                perPage: "{select} entri per halaman",
                noRows: "Tidak ada data ditemukan",
                info: "Menampilkan {start} sampai {end} dari {rows} entri",
            },
        });
    }

    // Konfirmasi Penghapusan dengan Notifikasi
    document.addEventListener('click', function (event) {
        if (event.target.matches('a.btn-warning')) {
            const confirmed = confirm('Yakin Data Di Hapus?');
            if (!confirmed) {
                event.preventDefault();
            } else {
                showToast('Data berhasil dihapus.', 'success');
            }
        }
    });

    // Menambahkan notifikasi untuk aksi CRUD
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `<div class="toast-body">${message}</div>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // Menambahkan filter pencarian tambahan
    const searchInput = document.querySelector('#search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const searchValue = searchInput.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    }

    // Memastikan tombol "Tambah" mengarahkan ke halaman yang benar
    const addButton = document.querySelector('#add-button');
    if (addButton) {
        addButton.addEventListener('click', function () {
            window.location.href = 'addbarang.php';
        });
    }
});

// Menambahkan stylesheet untuk notifikasi
const style = document.createElement('style');
style.textContent = `
.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px;
    border-radius: 5px;
    color: #fff;
    z-index: 1000;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
.toast-success {
    background-color: #28a745;
}
.toast-error {
    background-color: #dc3545;
}
.toast-body {
    display: flex;
    align-items: center;
}
.toast-icon {
    margin-right: 10px;
}
`;
document.head.appendChild(style);
