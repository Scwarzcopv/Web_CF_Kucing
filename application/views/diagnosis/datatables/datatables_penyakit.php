<tr class="closest">
    <td>
        <div class="d-flex"><?= $no; ?></div>
    </td>
    <td data-search="<?= $row['nama_penyakit']; ?>"><?= $row['nama_penyakit']; ?></td>
    <td><?= $row['detail_penyakit']; ?></td>
    <td><?= $row['saran_penyakit']; ?></td>
    <td>
        <div class="d-flex">
            <button type="button" class="btn btn-outline-primary me-1" name="btn_edit_penyakit" id="btn_edit_penyakit"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-outline-danger" name="btn_hapus_penyakit" id="btn_hapus_penyakit"><i class="fas fa-trash"></i></i></button>
        </div>
    </td>
</tr>