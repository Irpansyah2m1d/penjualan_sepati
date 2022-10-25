 <?php if(@$_SESSION["level"] === "2") : ?>
  <a href="keranjang.php" class="keranjang">
    <img src="img/keranjang.png" alt="Keranjang" width="80px" class="">
    <?php if(count($data_keranjang) > 0 ) : ?>
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
        <?= count($data_keranjang); ?>
        <span class="visually-hidden">unread messages</span>
      </span>
    <?php endif; ?>
  </a>
<?php endif; ?>
 </div>
 <section id="cta" class="mt-5 overlay left-0 right-0 bottom-0" >
		<div class="container">
			<div class="section-content" data-aos="fade-up">
				<div class="row">
					<div class="col-md-12 text-center">
						<h2 class="mb-2">Terpercaya, Tercepat, dan Berkualitas</h2>
            <p class="mx-auto text-center mb-0">&copy; 2022 Junior Web Developer A. Design by Programmer Merah | Kelompok 4</a>.</p>
          </div>
          <div class="col-lg-12 col-md-12 text-light">
             <nav class="nav nav-mastfoot justify-content-center">
                 <a class="nav-link" href="#">
                   <i class="fab fa-facebook-f text-light"></i>
                 </a>
                 <a class="nav-link" href="#">
                   <i class="fab fa-twitter text-light"></i>
                 </a>
                 <a class="nav-link" href="#">
                   <i class="fab fa-instagram text-light"></i>
                 </a>
                 <a class="nav-link" href="#">
                   <i class="fab fa-linkedin text-light"></i>
                 </a>
                 <a class="nav-link" href="#">
                   <i class="fab fa-youtube text-light"></i>
                 </a>
             </nav>
           </div>
				</div>
			</div>
		</div>
	</section>	
 <!-- <sec id="cta" class="mastfoot my-3 ">
    <div class="inner container ">
         <div class="row">
         	<div class="col-lg-4 col-md-12 d-flex align-items-center">
         		
         	</div>
         	<div class="col-lg-4 col-md-12 d-flex align-items-center">
         		<p class="mx-auto text-center mb-0">&copy; 2022 Junior Web Developer A. Design by Programmer Merah | Kelompok 4</a>.</p>
         	</div>
           
            <div class="col-lg-4 col-md-12">
            	<nav class="nav nav-mastfoot justify-content-center">
	                <a class="nav-link" href="#">
	                	<i class="fab fa-facebook-f"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-twitter"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-instagram"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-linkedin"></i>
	                </a>
	                <a class="nav-link" href="#">
	                	<i class="fab fa-youtube"></i>
	                </a>
	            </nav>
            </div>
            
        </div>
    </div>
</footer>	External JS -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script
      src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <!-- <script
      src="js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script> -->
    <script src="css/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/jquery-3.6.0.min.js"></script>
    <script src="dist/sweetalert2.all.min.js"></script>
    <script src="dist/myscript.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script src="vendor/bootstrap/popper.min.js"></script>
	<script src="vendor/bootstrap/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js "></script>
	<script src="vendor/owlcarousel/owl.carousel.min.js"></script>
	<script src="vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
	<script src="vendor/isotope/isotope.min.js"></script>
	<script src="vendor/lightcase/lightcase.js"></script>
	<script src="vendor/waypoints/waypoint.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script>
       // Awal JQUERY
    $(document).ready(function(){
      // let reset = $("#table").html();
      // $("#table").html(reset);
      // $("#table").html();
        $("#keyword").on("keyup", function(){
          if($("#keyword").val() == ''){
            // alert('ok');
            // let reset = $("#table").html();
            // $("#table").html(reset);
            $("#table").reset;
          }
          console.log($("#keyword").val());
            // $("#loader").show();
            $.get("ajax/data_mahasiswa.php?keyword=" + $("#keyword").val(), function(data){
                // Hasil
                $("#table").html(data);
                // $("#loader").hide();
            })
        })
        
        $('#show-password').click(function(){
      if($(this).is(':checked')){
        $('#recent-password').attr('type','text');
        $('#new-password').attr('type','text');
        $('#konfirmasi-password').attr('type','text');
      }else{
        $('#recent-password').attr('type','password');
        $('#new-password').attr('type','password');
        $('#konfirmasi-password').attr('type','password');
      }
    });
     //   Alert Login
    let dataSession = $("#session").data("login");
    if (dataSession) {
      swal.fire({
        title: "Login Success",
        icon: "success",
        text: "Selamat Datang " + dataSession,
      });
    }
    })
    </script>
    <script src="app.min.js "></script>
    <script>
      // Set the date we're counting down to
      var countDownDate = new Date("Oct 30, 2022 10:00:00").getTime();

      // Update the count down every 1 second
      var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("waktu").innerHTML = days + " Hari " + hours + " Jam "
        + minutes + " Menit " + seconds + " Detik ";

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("waktu").innerHTML = "EXPIRED";
        }
      }, 1000);

     
  $(".warna_produk").on("click", function(e){
    // console.log(e.target.getAttribute("data"));
      let warna = document.querySelectorAll(".warna_produk");
      warna.forEach((w) => {
       if(w.classList.contains("active-produk")){
        w.classList.remove("active-produk");
       } 
      })

      e.target.classList.add("active-produk");
    // e.target.classList.add("active-produk");
  })

   $(".tambahKeranjang").on("click", async function (e) {
    e.preventDefault();
    let warna = document.querySelectorAll(".warna_produk");
    let warna_pilih = null;
      warna.forEach((w) => {
       if(w.classList.contains("active-produk")){
       warna_pilih = w.getAttribute("data-warna");
       } 
      })
      console.log(warna_pilih);
    let nama = $(this).data("nama");
    let href = $(this).attr("href");
    const { value: ukuran } = await Swal.fire({
      title: "Pemesanan " + nama,
      input: "number",
      inputLabel: "Ukuran",
      confirmButtonText: "Next",
      inputPlaceholder: "Masukan Ukuran dari (30 - 43)",
    });
    const { value: jumlah } = await Swal.fire({
      title: "Pemesanan " + nama,
      input: "number",
      inputLabel: "Jumlah Barang",
      confirmButtonText: "Tambahkan",
      inputPlaceholder: "Masukan Jumlah Pesanan",
    });

    if (jumlah) {
      // Swal.fire(`Entered email: ${href}`);
      document.location.href = href + "&jml=" + jumlah + "&ukuran=" + ukuran + "&warna=" + warna_pilih;
    }
  });
  
  let total = 0;
  let hasil = document.querySelector('.hasil');

  $(".voucher").on("click", async function (e) {
  e.preventDefault();
   const { value: voucher } = await Swal.fire({
      title: "Voucher Spesial Event",
      input: "text",
      inputLabel: "Voucher",
      confirmButtonText: "Pakai",
      inputPlaceholder: "Silahkan masukan kode voucher",
    });
    if(localStorage.getItem("voucher") && voucher === "semogakompeten" ){
      Swal.fire("Voucher Sudah Dipakai!");
    }else {
      if(voucher === "semogakompeten"){
        Swal.fire({
          icon: 'success',
          title: 'Selamat Anda',
          text: 'Berhasil Mendapatkan diskon 15%'
        })
          total = total - ((total * 15)/100);
          hasil.value = total;
          localStorage.setItem("voucher", true);
      }else {
        Swal.fire("Kode Voucher Anda Salah!");
      }
    }
})
  let choosePsn = document.querySelectorAll('.pesanan');
  console.log(hasil);
  choosePsn.forEach((e) => {
  e.addEventListener("click", function () {
    // console.log(e.getAttribute('data-harga'));

    let harga = e.getAttribute("data-harga");
    e.classList.toggle("dipesan");
    if (e.classList.contains("dipesan")) {
      total += parseInt(harga);
    } else {
      total -= parseInt(harga);
    }
          let sesi = localStorage.getItem("voucher");
      if (sesi) {
        total = total - ((total * 15)/100);
        hasil.value = total;
      }else{
        hasil.value = total;
      }
  });
});

</script>
  </body>
</html>
