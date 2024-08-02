// document.addEventListener("DOMContentLoaded", function () {
//   const editModal = new bootstrap.Modal(document.getElementById("editModal"));
//   const editForm = document.getElementById("editForm");

//   document.querySelectorAll(".btn-edit").forEach((button) => {
//     button.addEventListener("click", function () {
//       const id = this.getAttribute("data-id");
//       const nama = this.getAttribute("data-nama");
//       const jumlah = this.getAttribute("data-jumlah");
//       const harga = this.getAttribute("data-harga");
//       const tanggal = this.getAttribute("data-tanggal");

//       document.getElementById("edit-id").value = id;
//       document.getElementById("edit-nama").value = nama;
//       document.getElementById("edit-jumlah").value = jumlah;
//       document.getElementById("edit-harga").value = harga;
//       document.getElementById("edit-tanggal").value = tanggal.split(" ")[0];

//       editModal.show();
//     });
//   });

//   editForm.addEventListener("submit", function (event) {
//     event.preventDefault();
//     const id = document.getElementById("edit-id").value;
//     const nama = document.getElementById("edit-nama").value;
//     const jumlah = document.getElementById("edit-jumlah").value;
//     const harga = document.getElementById("edit-harga").value;
//     const tanggal = document.getElementById("edit-tanggal").value;

//     // Lakukan AJAX request untuk mengupdate data
//     fetch(`edit.php?id=${id}`, {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify({ nama, jumlah, harga, tanggal }),
//     })
//       .then((response) => response.json())
//       .then((data) => {
//         if (data.success) {
//           window.location.reload();
//         } else {
//           alert("Gagal mengupdate data");
//         }
//       });
//   });

//   document.querySelectorAll(".btn-hapus").forEach((button) => {
//     button.addEventListener("click", function () {
//       const id = this.getAttribute("data-id");
//       if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
//         // Lakukan AJAX request untuk menghapus data
//         fetch(`hapus.php?id=${id}`, {
//           method: "POST",
//         })
//           .then((response) => response.json())
//           .then((data) => {
//             if (data.success) {
//               window.location.reload();
//             } else {
//               alert("Gagal menghapus data");
//             }
//           });
//       }
//     });
//   });
// });

document.getElementById('submitButton').addEventListener('click', function() {
  // Tampilkan spinner
  document.getElementById('loading').style.display = 'flex';

  // Kirim data ke server menggunakan AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'process.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function() {
      if (xhr.status === 200) {
          // Alihkan ke halaman lain setelah proses selesai
          window.location.href = 'new_page.php';
      } else {
          // Tangani kesalahan jika diperlukan
          console.error('Terjadi kesalahan saat memproses data.');
      }
  };

  xhr.send(); // Kirim request ke server
});