					<?php
					// Atur kode gejala
					$id = (int)@$row['id_p'];
					if ($id < 10) {
						$kode_penyakit = 'P00' . $id;
					} elseif ($id < 100) {
						$kode_penyakit = 'P0' . $id;
					} else {
						$kode_penyakit = 'P' . $id;
					}
					if (!@$row['id_p']) $kode_penyakit = 'G<span class="text-danger">?</span>';
					// Atur nama penyakit
					$penyakit = @$row['nama_penyakit'];
					if (@!$row['nama_penyakit']) $penyakit = '<span class="text-danger">?</span>';
					// Atur persentase
					$persentase = '<span class="text-danger">?</span>';
					if ($row['persentase']) $persentase = number_format($row['persentase'], 2);
					?>

					<tr>
						<th scope="row" class="align-middle"><?= $no; ?></th>
						<td><?= $kode_penyakit; ?></td>
						<td><?= $penyakit ?></td>
						<td><?= $persentase; ?>%</td>
						<td><?= $date_created; ?><br>(<?= $date_created_since; ?>)</td>
						<td>
							<button class="button-55" role="button" onclick="info(<?= $row['id_r']; ?>, '<?= $date_created_since; ?>')">Info <i class="far fa-info-square text-primary"></i></button>
							<button class="button-55" role="button" onclick="hapus(<?= $row['id_r']; ?>)">Hapus <i class="far fa-trash text-danger"></i></button>
						</td>
					</tr>