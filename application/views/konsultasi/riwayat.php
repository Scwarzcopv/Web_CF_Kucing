<!-- Nice Select CSS -->
<link rel="stylesheet" href="<?= base_url('assets/mediplus'); ?>/css/nice-select.css">
<style>
	/* CSS */
	.button-37 {
		background-color: #13aa52;
		border: 1px solid #13aa52;
		border-radius: 4px;
		box-shadow: rgba(0, 0, 0, .1) 0 2px 4px 0;
		box-sizing: border-box;
		color: #fff;
		cursor: pointer;
		font-family: "Akzidenz Grotesk BQ Medium", -apple-system, BlinkMacSystemFont, sans-serif;
		font-size: 17px;
		font-weight: 450;
		outline: none;
		outline: 0;
		padding: 10px 25px;
		text-align: center;
		transform: translateY(0);
		transition: transform 150ms, box-shadow 150ms;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-37:hover {
		box-shadow: rgba(0, 0, 0, .15) 0 3px 9px 0;
		transform: translateY(-2px);
	}

	/* CSS */
	.button-24 {
		background: #FF4742;
		border: 1px solid #FF4742;
		border-radius: 6px;
		box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
		box-sizing: border-box;
		color: #FFFFFF;
		cursor: pointer;
		display: inline-block;
		font-family: nunito, roboto, proxima-nova, "proxima nova", sans-serif;
		font-size: 16px;
		font-weight: 800;
		line-height: 16px;
		min-height: 40px;
		outline: 0;
		padding: 12px 14px;
		text-align: center;
		text-rendering: geometricprecision;
		text-transform: none;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
		vertical-align: middle;
	}

	.button-24:hover,
	.button-24:active {
		background-color: initial;
		background-position: 0 0;
		color: #FF4742;
	}

	.button-24:active {
		opacity: .5;
	}

	@media (min-width: 768px) {
		.button-37 {
			padding: 15px 30px;
		}
	}

	@media (min-width: 768px) {
		.modal-xl {
			width: 90%;
			max-width: 1200px;
		}
	}

	hr.solid {
		border-top: 4px solid #999;
	}

	.fas {
		-moz-transition: transform 0.25s;
		-webkit-transition: transform 0.25s;
		transition: transform 0.25s;
	}

	.rotate_90 {
		-webkit-transform: rotate(90deg);
		-moz-transform: rotate(90deg);
		-o-transform: rotate(90deg);
		-ms-transform: rotate(90deg);
		transform: rotate(90deg);
	}

	.rotate_min90 {
		-webkit-transform: rotate(0deg);
		-moz-transform: rotate(0deg);
		-o-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		transform: rotate(0deg);
	}
</style>
<style>
	/* CSS */
	.button-55 {
		align-self: center;
		background-color: #fff;
		background-image: none;
		background-position: 0 90%;
		background-repeat: repeat no-repeat;
		background-size: 4px 3px;
		border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
		border-style: solid;
		border-width: 2px;
		box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
		box-sizing: border-box;
		color: #41403e;
		cursor: pointer;
		display: inline-block;
		font-family: Neucha, sans-serif;
		font-size: 1rem;
		line-height: 23px;
		outline: none;
		padding: .75rem;
		text-decoration: none;
		transition: all 235ms ease-in-out;
		border-bottom-left-radius: 15px 255px;
		border-bottom-right-radius: 225px 15px;
		border-top-left-radius: 255px 15px;
		border-top-right-radius: 15px 225px;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-55:hover {
		box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
		transform: translate3d(0, 2px, 0);
	}

	.button-55:focus {
		box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
	}
</style>

<!-- Start Feautes -->
<div class="breadcrumbs overlay">
	<div class="container">
		<div class="bread-inner">
			<div class="row">
				<div class="col-12">
					<h2>Riwayat Konsultasi Penyakit</h2>
					<ul class="bread-list">
						<li><a href="<?= base_url('') ?>">Beranda</a></li>
						<li><i class="icofont-simple-right"></i></li>
						<li class="active">Riwayat</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="Feautes section mt-lg-5 pb-3 pt-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Riwayat Konsultasi Penyakit</h2>
					<img src="<?= base_url('assets/mediplus/'); ?>img/section-img.png" alt="#">
					<p>Silahkan cek riwayat dari konsultasi anda.</p>
					<p class="pt-0 mt-0">Anda dapat melihat, mencetak, & menghapus riwayat yang ada di bawah.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Feautes -->

<!-- Start Riwayat -->
<section class="konsultasi mb-5">
	<div class="container">
		<div class="row mb-4 mt-3 mt-lg-0">
			<div class="col-12 col-lg-7 mb-2 mb-lg-0 d-flex align-items-center">
				<table class="p-0 m-0 w-auto">
					<tr>
						<td>
							<div class="input-group"><span class="card-title my-auto me-3 d-none d-md-block">Urut Berdasar</span></div>
						</td>
						<td>
							<div class="input-group">
								<span class="card-title my-auto me-3 d-none d-md-block">:</span>
							</div>
						</td>
						<td>
							<div class="input-group">
								<!-- <div class="col-md-4 col-lg-5 me-3"> -->
								<select class="rounded pt-2 mb-0 me-3 fw-medium" id="order" style="max-width: 10rem;">
									<option value="a.date_created DESC" selected>Data Baru</option>
									<option value="a.date_created ASC">Data Lama</option>
									<option value="b.id ASC">Kode ⇩</option>
									<option value="b.id DESC">Kode ⇪</option>
									<option value="b.nama_penyakit ASC">Nama Penyakit ⇩</option>
									<option value="b.nama_penyakit DESC">Nama Penyakit ⇪</option>
									<option value="a.persentase ASC">Persentase ⇩</option>
									<option value="a.persentase DESC">Persentase ⇪</option>
								</select>
								<!-- </div> -->
							</div>
						</td>
					</tr>
					<tr class="spasi">
						<td>
							<div class="p-1"></div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="card-title my-auto me-3 d-none d-md-block">Muat</span>
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="card-title my-auto me-3 d-none d-md-block">:</span>
							</div>
						</td>
						<td>
							<div class="input-group">
								<select class="rounded pt-2 mb-0 me-3 fw-medium" id="show" style="max-width: 10rem;">
									<option value=5 selected>5</option>
									<option value=10>10</option>
									<option value=20>20</option>
									<option value=50>50</option>
									<option value=100>100</option>
								</select>
								<span class="card-title my-auto">dari (<span id="num_rows">0</span>) Data</span>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-12 col-lg-5 d-flex align-items-center">
				<div class="input-group input-group-md">
					<input type="search" class="form-control border my-0 py-0" id="keyword" placeholder="Search Filter">
					<span class="btn border" style="cursor: default;"><i class="fa-solid fa-magnifying-glass"></i> Search</span>
				</div>
			</div>
		</div>
		<table id="" class="table table-responsive table-hover" style="width:100%">
			<thead class="table-primary">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Kode</th>
					<th scope="col">Nama Penyakit</th>
					<th scope="col">Persentase</th>
					<th scope="col">Waktu</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody id="load_data">
			</tbody>
		</table>
		<div id="load_data_message"></div>
	</div>
</section>
<!--/ End Konsultasi -->

<!-- Footer Area -->
<footer id="footer" class="footer p-0">
	<!-- Footer Top -->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-footer">
						<h2>About Us</h2>
						<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut
							labore dolore magna.</p>
						<!-- Social -->
						<ul class="social">
							<li><a href="#"><i class="icofont-facebook"></i></a></li>
							<li><a href="#"><i class="icofont-instagram"></i></a></li>
						</ul>
						<!-- End Social -->
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-footer">
						<h2>Open Hours</h2>
						<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.
						</p>
						<ul class="time-sidual">
							<li class="day">Senin - Kamis <span>08.00-20.00</span></li>
							<li class="day">Jumat <span>09.00-18.30</span></li>
							<li class="day">Sabtu & Minggu <span>09.00-15.00</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Footer Top -->
	<!-- Copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div class="copyright-content">
						<p>©2024 | Sistem Pakar - Diagnosa Penyakit Pada Kucing </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Copyright -->
</footer>

<!-- Start Modal -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="staticBackdropLabel">Hasil Diagnosis</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-2 mt-2 float-end" id="since">Minggu</div>
				<div class="fw-bold mb-2 mt-2" id="penginput">Hasil input dari username : </div>
				<!-- Tabel Input User -->
				<table class="table table-responsive table-hover mb-lg-4">
					<thead class="table-primary">
						<tr>
							<th scope="col" class="">No</th>
							<th scope="col" class="">Kode</th>
							<th scope="col" class="">Gejala</th>
							<th scope="col" class="">Kondisi</th>
						</tr>
					</thead>
					<tbody id="tbody_modal_input">
					</tbody>
				</table>
				<hr class="solid" />
				<div id="table_modal_diagnosa">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="print()">Print <i class="far fa-print"></i></button>
				<button type="button" class="button-24" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--/ End Modal -->


<!-- Js -->
<!-- Src -->
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script type="text/javascript" src=""></script>
<!-- Init -->
<script>
	let class_pilihan = $('.class_pilihan');
	var arrVal = []; //Isinya obj inputan id & pilihan
</script>

<!-- Infinite Scroll -->
<script>
	// var data_elem = [];
	var limit = 5;
	var start = 0;
	var action = 'inactive';
	var keyword = '';
	var order = 'a.date_created DESC';
	var timeout = null;
	// Effect
	const placeholder_timer = 1000;

	function func_loader_spinner() {
		var output = '';
		output += '<div class="d-flex justify-content-center">';
		output += '<div class="spinner-border text-primary fw-bold fs-2 my-2" role="status">';
		output += '<span class="visually-hidden">Loading...</span>';
		output += '</div>';
		output += '</div>';
		$('#load_data_message').html(output);
	}

	function load_data(limit, start, keyword, order) {
		$.ajax({
			url: "<?php echo base_url(); ?>konsultasi/fetch_riwayat",
			method: "POST",
			data: {
				limit: limit,
				start: start,
				keyword: keyword,
				order: order
			},
			dataType: "JSON",
			cache: false,
			success: function(resp) {
				$('#num_rows').html(resp.num_rows);
				if (resp.data == 'null') {
					$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
					action = 'active';
				} else if (resp.data == 'null2') {
					if (keyword == '' || keyword == null) {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
						action = 'active';
					} else {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Tidak Ditemukan</div>');
						action = 'active';
					}
				} else {
					// data_elem.push(data);
					// $('#load_data').html(data_elem);
					$(resp.data).appendTo('#load_data').slideUp(0).slideDown(1000, 'easeInOutExpo', function() {});
					if (resp.next == 'true') {
						$('#load_data_message').html("");
						action = 'inactive';
					} else {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
						action = 'active'
					}
				}
			}
		})
	}

	function reloadDT() {
		$('#load_data').empty();
		$('#load_data').html('');
		start = 0;
		action = 'inactive';
		func_loader_spinner();
		if (timeout !== null) {
			clearTimeout(timeout);
		}
		timeout = setTimeout(function() {
			load_data(limit, start, keyword, order);
		}, placeholder_timer);
	}

	$(document).ready(function() {
		func_loader_spinner();

		if (action == 'inactive') {
			action = 'active';
			load_data(limit, start, keyword, order);
		}

		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
				func_loader_spinner();
				action = 'active';
				start = start + limit;
				setTimeout(function() {
					load_data(limit, start, keyword, order);
				}, placeholder_timer); //Buat animasi doang
			}
		});

		// Search
		$('#keyword').on('input', function() {
			keyword = $(this).val();
			start = 0;
			action = 'inactive';
			// var e = $('<div id="load_data"></div>');
			// $('#load_data').empty().remove();
			// $('#row_data').append(e);
			reloadDT();
			// console.log(keyword);
			// if (keyword != '') {
			//     infinite_scroll(keyword);
			// } else {
			//     infinite_scroll();
			// }
		});

		// Order
		$('#order').on('change', function() {
			order = $(this).find(":selected").val();
			reloadDT();
		});

		// Order
		$('#show').on('change', function() {
			limit = parseInt($(this).find(":selected").val());
			reloadDT();
		});
	});
</script>

<!-- Aksi -->
<script>
	function info(id_r, since) {
		var role_id = <?= $user['role_id']; ?>;
		var username = '<?= $user['username']; ?>';
		if (role_id > 2) $('#penginput').html('Hasil input dari username : ' + username + '');
		if (role_id < 3) $('#penginput').html('Hasil input dari username : <i class="fas fa-badge-check text-success"></i> ' + username + '');
		$('#since').html(since);
		$.ajax({
			url: "<?= base_url(); ?>konsultasi/info_riwayat",
			method: "POST",
			data: {
				id_r: id_r
			},
			dataType: "JSON",
			cache: false,
			success: function(resp) {
				console.clear();
				$('#tbody_modal_input').append(resp.input_user);
				$('#table_modal_diagnosa').append(resp.hasil_akhir);
				$('#modal').modal('show');
			}
		})
		$('#modal').on('hidden.bs.modal', function() {
			$('#tbody_modal_input').html('');
			$('#table_modal_diagnosa').html('');
		});
	}

	function hapus(id_r) {
		Swal.fire({
			title: "Hapus data riwayat?",
			html: "Semua data terkait riwayat ini akan dihapus <br><span class='fw-bold'>secara permanen</span>.",
			// html: "Semua data terkait gejala ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "<?= base_url(); ?>konsultasi/hapusDataRiwayat",
					method: "POST",
					data: {
						id_r: id_r
					},
					dataType: "JSON",
					cache: false,
					success: function(resp) {
						reloadDT();
						Custom.fire({
							icon: 'success',
							title: 'Data riwayat berhasil dihapus',
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(errorThrown);
						// console.error(this.props.url, status, err.toString());
						Swal.fire({
							icon: 'error',
							title: textStatus,
							text: errorThrown,
						});
					}
				})
			}
		})
	}
</script>

<!--  -->
<script>
	// Fungsi Kirim Inputan

	function detailPenyakitLain(id_penyakit) {
		if ($('#detail_penyakit_lain_' + id_penyakit).hasClass("d-none")) {
			$('#detail_penyakit_lain_' + id_penyakit).removeClass('d-none').slideUp(0).slideDown(500, 'easeInOutExpo');
			$('#caret_' + id_penyakit).toggleClass('rotate_90');
		} else {
			$('#detail_penyakit_lain_' + id_penyakit).slideUp(500, 'easeInOutExpo', function() {
				$(this).addClass('d-none');
			});
			$('#caret_' + id_penyakit).toggleClass('rotate_90');
		}
	}

	function print() {
		$('.modal-body').printThis({
			importCSS: true, // import parent page css
			importStyle: true, // import style tags
			printContainer: true, // print outer container/$.selector
			pageTitle: "Hasil Diagnosa",
			header: "<h5 class='text-center mt-4 mb-2'>Diagnosa Penyakit Kucing Metode Certainty Factor</h5>",
			loadCSS: [
				'https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap',
				'<?= base_url('assets/mediplus'); ?>/css/bootstrap.min.css',
				'<?= base_url('assets/mediplus'); ?>/css/nice-select.css',
				'<?= base_url('assets/mediplus'); ?>/css/normalize.css',
				'<?= base_url('assets/mediplus'); ?>/style.css',
				'<?= base_url('assets/mediplus'); ?>/css/responsive.css',
			],
		});
	}
</script>


<script>
	$(document).ready(function() {
		// setTimeout(function() {
		// 	console.clear();
		// }, 300);
		// ambilInput();
	});
</script>