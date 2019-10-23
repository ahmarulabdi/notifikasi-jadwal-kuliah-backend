<?php

class JadwalKuliah extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id_jadwal_kuliah", type="integer", length=11, nullable=false)
     */
    public $id_jadwal_kuliah;

    /**
     *
     * @var string
     * @Column(column="kode", type="string", length=100, nullable=false)
     */
    public $kode;

    /**
     *
     * @var string
     * @Column(column="nama", type="string", length=250, nullable=false)
     */
    public $nama;

    /**
     *
     * @var string
     * @Column(column="tempat", type="string", length=250, nullable=true)
     */
    public $tempat;

    /**
     *
     * @var string
     * @Column(column="hari", type="string", nullable=true)
     */
    public $hari;
    public $urutan_hari;

    /**
     *
     * @var string
     * @Column(column="jam_mulai", type="string", nullable=true)
     */
    public $jam_mulai;

    /**
     *
     * @var string
     * @Column(column="jam_selesai", type="string", nullable=true)
     */
    public $jam_selesai;

    /**
     *
     * @var integer
     * @Column(column="sks", type="integer", length=10, nullable=false)
     */
    public $sks;

    /**
     *
     * @var integer
     * @Column(column="nip", type="integer", length=50, nullable=true)
     */
    public $nip;

    /**
     *
     * @var string
     * @Column(column="semester", type="string", length=20, nullable=true)
     */
    public $semester;

    /**
     *
     * @var string
     * @Column(column="keterangan", type="string", nullable=true)
     */
    public $keterangan;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("jadwal_kuliah");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'jadwal_kuliah';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JadwalKuliah[]|JadwalKuliah|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JadwalKuliah|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function beforeSave()
    {
        $hari = $this->hari;
        $i = null ;
        switch ($hari){
            case 'minggu' : $i = 0;break;
            case 'senin' : $i = 1;break;
            case 'selasa' : $i = 2;break;
            case 'rabu' : $i = 3;break;
            case 'kamis' : $i = 4;break;
            case 'jumat' : $i = 5;break;
            case 'sabtu' : $i = 6;break;
        }

        $this->urutan_hari = $i;

    }

}
