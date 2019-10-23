<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 13/08/18
 * Time: 21:51
 */

class JadwalKuliahAdd
{
    public $id_jadwal_kuliah;
    public $kode;
    public $nama;
    public $tempat;
    public $hari;
    public $jam_mulai;
    public $jam_selesai;
    public $sks;
    public $nip;
    public $nama_dosen;
    public $semester;
    public $keterangan;
    public function __construct($id_jadwal_kuliah)
    {
        $jadwal_kuliah = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);

        $this->id_jadwal_kuliah = $jadwal_kuliah->id_jadwal_kuliah;
        $this->kode = $jadwal_kuliah->kode;
        $this->nama = $jadwal_kuliah->nama;
        $this->tempat = $jadwal_kuliah->tempat;
        $this->hari = $jadwal_kuliah->hari;
        $this->jam_mulai = $jadwal_kuliah->jam_mulai;
        $this->jam_selesai = $jadwal_kuliah->jam_selesai;
        $this->sks = $jadwal_kuliah->sks;
        $this->nip = $jadwal_kuliah->nip;
        $this->nama_dosen = Users::findFirstByNipNim($jadwal_kuliah->nip)->nama;
        $this->semester = $jadwal_kuliah->semester;
        $this->keterangan = $jadwal_kuliah->keterangan;
    }

}