<?php

class NotifikasiHalangan extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_notifikasi;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id_detail_jadwal_kuliah;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $pesan;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $timestamp;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("notifikasi_halangan");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'notifikasi_halangan';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return NotifikasiHalangan[]|NotifikasiHalangan|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return NotifikasiHalangan|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
