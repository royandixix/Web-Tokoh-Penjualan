// main.js

// Memuat pustaka eksternal
const script1 = document.createElement('script');
script1.src = "https://code.jquery.com/jquery-3.7.1.js";
document.head.appendChild(script1);

const script2 = document.createElement('script');
script2.src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js";
document.head.appendChild(script2);

const script3 = document.createElement('script');
script3.src = "https://cdn.datatables.net/2.1.3/js/dataTables.js";
document.head.appendChild(script3);

const script4 = document.createElement('script');
script4.src = "https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js";
document.head.appendChild(script4);

// Pastikan semua pustaka telah dimuat sebelum inisialisasi DataTables
script4.onload = function() {
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Berikutnya",
                    "sLast": "Terakhir"
                }
            }
        });
    });
};
