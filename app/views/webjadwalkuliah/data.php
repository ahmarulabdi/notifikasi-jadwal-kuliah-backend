<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 12/08/18
 * Time: 23:35
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">ADMINISTRATOR JADWAL KULIAH</h4>
    </div>
    <div class="panel-body">
        <?php $this->flashSession->output() ?>
        <a href="<?= $this->url->get("webjadwalkuliah/create") ?>" class="btn btn-success">Tambah Mata Kuliah</a>
        <table class="table table-bordered dataTable">
            <thead>
            <tr>
                <th>kode</th>
                <th>nama</th>
                <th>sks</th>
                <th>semester</th>
                <th>tempat</th>
                <th>hari</th>
                <th>jam mulai</th>
                <th>jam selesai</th>
                <th>dosen</th>
                <th>opsi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($jadwal_kuliahs as $jadwal_kuliah) : ?>
                <tr>
                    <td><?= $jadwal_kuliah->kode ?></td>
                    <td><?= $jadwal_kuliah->nama ?></td>
                    <td><?= $jadwal_kuliah->sks ?></td>
                    <td><?= $jadwal_kuliah->semester ?></td>
                    <td><?= $jadwal_kuliah->tempat ?></td>
                    <td><?= $jadwal_kuliah->hari ?></td>
                    <td><?= $jadwal_kuliah->jam_mulai ?></td>
                    <td><?= $jadwal_kuliah->jam_selesai ?></td>
                    <td><?= $jadwal_kuliah->nama_dosen ?></td>
                    <td>
                        <a class="btn btn-info btn-sm"
                           href="<?= $this->url->get("webjadwalkuliah/edit/$jadwal_kuliah->id_jadwal_kuliah") ?>">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                                onclick="deleteJadwal('<?= $jadwal_kuliah->id_jadwal_kuliah ?>')">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade " id="modalDelete" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    konfirmasi
                </h4>
            </div>
            <form action="<?= $this->url->get('webjadwalkuliah/delete') ?>" method="post">
                <div class="modal-body">
                    apakah anda yakin hapus jadwal kuliah ini ?
                    <input type="hidden" id="id_jadwal_kuliah" name="id_jadwal_kuliah">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya</button>
                    <button data-dismiss="modal" type="button" class="btn btn-default">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteJadwal(idJadwalKuliah) {

        $("#id_jadwal_kuliah").val(idJadwalKuliah);
    }
</script>