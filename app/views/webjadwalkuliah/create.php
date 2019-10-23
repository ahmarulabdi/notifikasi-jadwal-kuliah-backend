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
        <form action="" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mata Kuliah</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="sks">SKS</label>
                    <input type="number" name="sks" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" name="semester" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nip">Dosen</label>
                    <select name="nip" id="nip" class="form-control" required>
                        <option value="">-</option>
                        <?php foreach ($dosens as $dosen): ?>
                            <option value="<?= $dosen->nip_nim ?>"><?= $dosen->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" name="tempat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control">
                        <option value="">-</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control">
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus"></i>
                    Tambah
                </button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a type="button" class="btn btn-danger" href="<?= $this->url->get('webjadwalkuliah/data') ?>">
                    <i class="glyphicon glyphicon-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>