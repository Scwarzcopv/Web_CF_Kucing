<!-- Tabel Hasil Diagnosa Penyakit -->
<?php //var_dump($row); 
$nama_penyakit = '?';
$persentase = '?';
$detail_penyakit = '?';
$saran_penyakit = '?';
$kode_penyakit = '?';
$gambar = @$row[0]['img_penyakit'];
if ($row) {
	if ($row[0]['nama_penyakit'] != null) $nama_penyakit = $row[0]['nama_penyakit'];
	if ($row[0]['persentase'] != null) $persentase = number_format($row[0]['persentase'], 2);
	if ($row[0]['detail_penyakit'] != null) $detail_penyakit = $row[0]['detail_penyakit'];
	if ($row[0]['saran_penyakit'] != null) $saran_penyakit = $row[0]['saran_penyakit'];

	$id = (int)$row[0]['id_penyakit'];
	if ($id < 1) {
		$kode_penyakit = '?';
	} else if ($id < 10) {
		$kode_penyakit = 'P00' . $id;
	} elseif ($id < 100) {
		$kode_penyakit = 'P0' . $id;
	} else {
		$kode_penyakit = 'P' . $id;
	}
}
if ($gambar == 'gambar_penyakit_default.png') $gambar = base_url('assets/img/default/gambar_penyakit_default.png');
else $gambar = base_url('assets/img/penyakit/') . $gambar;
?>
<table class="table table-responsive table-bordered border-success border-5 mt-lg-4">
	<thead class="table-success">
		<tr>
			<th scope="col" class="col-md-1">Diagnosa Penyakit</th>
		</tr>
	</thead>
	<tbody id="">
		<tr>
			<th scope="col" class="fs-3 fw-bold lh-lg">
				<span class="text-danger"><?= $kode_penyakit; ?></span> <?= $nama_penyakit ?><br>(<?= $persentase ?>%)
				<div class="fs-5 fw-normal text-center mt-2 user-select-none">
					<img alt="Gambar Penyakit" src="<?= $gambar; ?>" id="sample_image" class="rounded border border-1 border-secondary img-responsive" width="200" height="200" />
				</div>
			</th>
		</tr>
	</tbody>
</table>
<!-- Tabel Detail Penyakit -->
<table class="table table-responsive table-bordered border-info border-5">
	<thead class="table-info">
		<tr>
			<th scope="col" class="col-md-1">Detail Penyakit</th>
		</tr>
	</thead>
	<tbody id="">
		<tr>
			<td scope="col"><?= $detail_penyakit ?></td>
		</tr>
	</tbody>
</table>
<!-- Tabel Saran Penyakit -->
<table class="table table-responsive table-bordered border-warning border-5 mb-lg-4">
	<thead class="table-warning">
		<tr>
			<th scope="col" class="col-md-1">Solusi Penyakit</th>
		</tr>
	</thead>
	<tbody id="">
		<tr>
			<td scope="col"><?= $saran_penyakit ?></td>
		</tr>
	</tbody>
</table>
<hr class="solid" />
<!-- Tabel Kemungkinan Penyakit Lain -->
<?php array_shift($row); ?>
<table class="table table-responsive table-hover table-bordered border-danger border-5 mt-lg-4">
	<thead class="table-danger">
		<tr>
			<th colspan="2" scope="col" class="col-md-1">Kemungkinan Penyakit Lain</th>
		</tr>
	</thead>
	<tbody id="">
		<?php if (count($row) > 0) : ?>
			<?php foreach ($row as $r) : ?>
				<tr onclick="detailPenyakitLain(<?= $r['id_penyakit']; ?>)">
					<?php
					$id = (int)$r['id_penyakit'];
					if ($id < 1) {
						$kode_penyakit = '?';
					} else if ($id < 10) {
						$kode_penyakit = 'P00' . $id;
					} elseif ($id < 100) {
						$kode_penyakit = 'P0' . $id;
					} else {
						$kode_penyakit = 'P' . $id;
					}
					$nama_penyakit = '?';
					$persentase = '?';
					if ($r['nama_penyakit'] != null) $nama_penyakit = $r['nama_penyakit'];
					if ($r['persentase'] != null) $persentase = number_format($r['persentase'], 2);
					$gambar = $r['img_penyakit'];
					if ($gambar == 'gambar_penyakit_default.png') $gambar = base_url('assets/img/default/gambar_penyakit_default.png');
					else $gambar = base_url('assets/img/penyakit/') . $gambar;
					?>
					<th scope="col">
						<i class="fas fa-caret-circle-right" id="caret_<?= $r['id_penyakit']; ?>"></i> <span class="text-danger"><?= $kode_penyakit; ?></span> <?= $nama_penyakit; ?> (<?= $persentase ?>%)
						<div class="d-none" id="detail_penyakit_lain_<?= $r['id_penyakit']; ?>">
							<div class="ms-3">
								<i class="fas fa-circle fa-xs"></i> Detail Penyakit:
								<div class="ms-3 fw-normal">
									<?= $r['detail_penyakit']; ?>
								</div>
							</div>
							<div class="ms-3">
								<i class="fas fa-circle fa-xs"></i> Saran Penyakit:
								<div class="ms-3 fw-normal">
									<?= $r['saran_penyakit']; ?>
								</div>
							</div>
							<div class="fs-5 fw-normal mt-2 user-select-none">
								<img alt="Gambar Penyakit" src="<?= $gambar; ?>" id="sample_image" class="rounded border border-1 border-secondary img-responsive" width="128" height="128" />
							</div>
						</div>
					</th>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (count($row) <= 0) : ?>
			<tr>
				<!-- <th scope="col"><span class="text-danger">?</span> ? (?%)</th> -->
				<th scope="col">-</th>
			</tr>
		<?php endif; ?>
	</tbody>
</table>