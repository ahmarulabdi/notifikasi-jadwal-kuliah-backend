<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 21/08/18
 * Time: 20:26
 */

?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="btn btn-default" href="<?= $this->url->get("webjadwalkuliah/data") ?>">
                <i class="glyphicon glyphicon-arrow-left"></i>
            </a>
            Mata Kuliah yang diajarkan
        </h4>
    </div>
    <div class="panel-body">
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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($jadwal_kuliah_dosens as $jadwal_kuliah_dosen) : ?>
                <tr>
                    <td><?= $jadwal_kuliah_dosen->kode ?></td>
                    <td><?= $jadwal_kuliah_dosen->nama ?></td>
                    <td><?= $jadwal_kuliah_dosen->sks ?></td>
                    <td><?= $jadwal_kuliah_dosen->semester ?></td>
                    <td><?= $jadwal_kuliah_dosen->tempat ?></td>
                    <td><?= $jadwal_kuliah_dosen->hari ?></td>
                    <td><?= $jadwal_kuliah_dosen->jam_mulai ?></td>
                    <td><?= $jadwal_kuliah_dosen->jam_selesai ?></td>
                    <td><?= $jadwal_kuliah_dosen->nama_dosen ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
