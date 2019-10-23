<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 21/08/18
 * Time: 17:07
 */ ?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="btn btn-default" href="<?= $this->url->get("webjadwalkuliah/data") ?>">
                <i class="glyphicon glyphicon-arrow-left"></i>
            </a>
            KRS : Jadwal Kuliah
        </h4>
    </div>
    <div class="panel-body">
        <table>
            <tr>
                <td>Nama</td>
                <td>: <?= $users->nama ?></td>
            </tr>
            <tr>
                <td>Sebagai</td>
                <td>: <?= $users->hak_akses ?></td>
            </tr>
        </table>
        <?php $this->flashSession->output() ?>

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
            <?php foreach ($detailmakuls as $detailmakul) : ?>
                <tr>
                    <td><?= $detailmakul['data']->kode ?></td>
                    <td><?= $detailmakul['data']->nama ?></td>
                    <td><?= $detailmakul['data']->sks ?></td>
                    <td><?= $detailmakul['data']->semester ?></td>
                    <td><?= $detailmakul['data']->tempat ?></td>
                    <td><?= $detailmakul['data']->hari ?></td>
                    <td><?= $detailmakul['data']->jam_mulai ?></td>
                    <td><?= $detailmakul['data']->jam_selesai ?></td>
                    <td><?= $detailmakul['data']->nama_dosen ?></td>
                    <td>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete"
                                    onclick="deleteJadwalUsers('<?= $detailmakul['id_detail_jadwal_kuliah'] ?>')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Konfirmasi penghapusan KRS</h4>
            </div>
            <form action="<?= $this->url->get("webusers/deletemakulkrs") ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_users" value="<?= $users->id_users ?>">
                    <input type="hidden" id="idDetailJadwalKuliah" name="id_detail_jadwal_kuliah">
                    Delete Jadwal Kuliah yang diambil <?= $users->hak_akses ?> <?= $users->nama ?> pada KRS ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function deleteJadwalUsers(idDetailJadwalKuliah) {
        $('#idDetailJadwalKuliah').val(idDetailJadwalKuliah);
    }

</script>