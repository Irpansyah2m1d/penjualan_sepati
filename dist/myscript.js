$(function () {
  $(".konfirmasiLogout").on("click", function () {
    e.preventDefault();
    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Keluar",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Keluar",
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = $(this).attr("href");
      }
    });
  });

  //   Pesan Konfirmasi Semua
  $(".tombolKonfirmasi").on("click", function (e) {
    e.preventDefault();
    let data = $(this).data("konfirmasi");
    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Data " + data + " Akan Di hapus",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Hapus Data!",
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = $(this).attr("href");
      }
    });
  });

  $(".hapusMahasiswa").on("click", function (e) {
    e.preventDefault();
    let data = $(this).data("konfirmasi");

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Seluruh Data " + data + " Akan Di hapus secara PERMANEN!!!",
      icon: "warning",
      backdrop: `
    rgba(255,0,0,0.5)
    left top
    no-repeat
    `,
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Hapus Data!",
    }).then((result) => {
      if (result.isConfirmed) {
        let timerInterval;
        Swal.fire({
          title: "Menghapus data secara PERMANEN",
          html: "Pemrosesan selesai dalam <b></b> milliseconds.",
          timer: 3000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft();
            }, 100);
          },
          showCloseButton: true,
          willClose: () => {
            clearInterval(timerInterval);
          },
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            document.location.href = $(this).attr("href");
          }
        });
      }
    });
  });

  // Pesan Hapus dan Update
  var data = $("#data-flash").data("flash");
  let info = $("#data-info").data("info");
  if (info) {
    Swal.fire({
      title: "GAGAL",
      text: info,
      icon: "warning",
    });
  } else {
    if (data) {
      var data = data.split(" ");
      if (data[1] === "True") {
        Swal.fire({
          title: "Data " + data[2],
          text: "Berhasil " + data[0],
          icon: "success",
        });
      } else {
        Swal.fire({
          title: "Data " + data[2],
          text: "Gagal " + data[0],
          icon: "error",
        });
      }
    }
  }
});
