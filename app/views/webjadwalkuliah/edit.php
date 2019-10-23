<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 13/08/18
 * Time: 22:23
 */
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="btn btn-default" href="<?= $this->url->get("webjadwalkuliah/data") ?>">
                <i class="glyphicon glyphicon-arrow-left"></i>
            </a>
             Tambah Jadwal Kuliah</h4>
    </div>
    <div class="panel-body">
        <?php $this->flashSession->output() ?>
        <form action="<?= $this->url->get("webjadwalkuliah/update") ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="hidden" name="id_jadwal_kuliah" value="<?= $jadwal_kuliah->id_jadwal_kuliah ?>" class="form-control" required>
                    <input type="text" name="kode" value="<?= $jadwal_kuliah->kode ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mata Kuliah</label>
                    <input type="text" name="nama" value="<?= $jadwal_kuliah->nama ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sks">SKS</label>
                    <input type="number" name="sks" value="<?= $jadwal_kuliah->sks ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" name="semester" value="<?= $jadwal_kuliah->semester ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nip">Dosen</label>
                    <select name="nip" id="nip" class="form-control" required>
                        <option value="">-</option>
                        <?php foreach ($dosens as $dosen): ?>
                            <option <?= $jadwal_kuliah->nip == $dosen->nip_nim ? 'selected' : '' ?> value="<?= $dosen->nip_nim ?>"><?= $dosen->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" name="tempat" value="<?= $jadwal_kuliah->tempat ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control">
                        <option value="">-</option>
                        <option <?= $jadwal_kuliah->hari == 'senin' ? 'selected' : '' ?> value="senin">Senin</option>
                        <option <?= $jadwal_kuliah->hari == 'selasa' ? 'selected' : '' ?> value="selasa">Selasa</option>
                        <option <?= $jadwal_kuliah->hari == 'rabu' ? 'selected' : '' ?> value="rabu">Rabu</option>
                        <option <?= $jadwal_kuliah->hari == 'kamis' ? 'selected' : '' ?> value="kamis">Kamis</option>
                        <option <?= $jadwal_kuliah->hari == 'jumat' ? 'selected' : '' ?> value="jumat">Jumat</option>
                        <option <?= $jadwal_kuliah->hari == 'sabtu' ? 'selected' : '' ?> value="sabtu">Sabtu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="<?= $jadwal_kuliah->jam_mulai ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="<?= $jadwal_kuliah->jam_selesai ?>" class="form-control">
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Perbarui
                </button>
                <a type="button" class="btn btn-danger" href="<?= $this->url->get('webjadwalkuliah/data') ?>">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
