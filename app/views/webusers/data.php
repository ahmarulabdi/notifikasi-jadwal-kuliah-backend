<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 21/08/18
 * Time: 15:13
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            Kelola Users
        </h4>
    </div>
    <div class="panel-body">
        <?php $this->flashSession->output(); ?>
        <div class="btn btn-group">
            <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                Tambah Users
            </button>
        </div>
        <table class="table table-bordered dataTable">
            <thead>
            <tr>
                <th>ID Users</th>
                <th>nama</th>
                <th>NIDN / NIM</th>
                <th>hak akses</th>
                <th>opsi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->id_users ?></td>
                    <td><?= $user->nama ?></td>
                    <td><?= $user->nip_nim ?></td>
                    <td><?= $user->hak_akses ?></td>
                    <td>
                        <button onclick="modalEdit(<?= $user->id_users ?>,'<?= $user->nama ?>','<?= $user->nip_nim ?>','<?= $user->hak_akses ?>')"
                                data-target="#modalEdit" data-toggle="modal"
                                class="btn btn-info btn-sm">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                        <button onclick="modalDelete(<?= $user->id_users ?>)" data-toggle="modal"
                                data-target="#modalDelete"
                                class="btn btn-sm btn-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>

                        <?php if ($user->hak_akses == "dosen") : ?>
                            <a href="<?= $this->url->get("webusers/dosenmakul/$user->nip_nim") ?>"
                               class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-zoom-in"></i>
                            </a>
                        <?php elseif ($user->hak_akses == "mahasiswa"): ?>
                            <a href="<?= $this->url->get("webusers/detailmakul/$user->id_users") ?>"
                               class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-zoom-in"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="alert alert-info">Informasi :
            <p>
                Password secara otomatis adalah NIP / NIM pada saat tambah users atau edit users
            </p>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-header">
                    Tambah Users
                </h4>
            </div>
            <form action="<?= $this->url->get("webusers/create") ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaTambah">Nama</label>
                        <input type="text" name="nama" class="form-control" id="namaTambah">
                    </div>
                    <div class="form-group">
                        <label for="nipNimTambah">NIDN / NIM</label>
                        <input type="number" name="nip_nim" class="form-control" id="nipNimTambah">
                    </div>
                    <div class="form-group">
                        <label for="hakAksesTambah">Hak Akses</label>
                        <select type="text" name="hak_akses" id="hakAksesTambah" class="form-control">
                            <option value="administrator">Administrator</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Users</h4>
            </div>
            <form action="<?= $this->url->get("webusers/update") ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idUsers" name="id_users">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="nipNim">NIDN / NIM</label>
                        <input type="number" name="nip_nim" id="nipNim" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hakAkses">Hak Akses</label>
                        <select type="text" name="hak_akses" id="hakAkses" class="form-control">
                            <option value="administrator">Administrator</option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Users</h4>
            </div>
            <form action="<?= $this->url->get("webusers/delete") ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idUsersDelete" name="id_users">
                    Apakah anda ingin menghapus user ini ?
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    function modalEdit(idUsers, nama, nipNim, hakAkses) {
        $('#idUsers').val(idUsers);
        $('#nama').val(nama);
        $('#nipNim').val(nipNim);
        $('#hakAkses').val(hakAkses);
    }

    function modalDelete(idUsers) {
        $('#idUsersDelete').val(idUsers);
    }
</script>
