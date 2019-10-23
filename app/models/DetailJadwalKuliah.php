<?php

class DetailJadwalKuliah extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id_detail_jadwal_kuliah", type="integer", length=11, nullable=false)
     */
    public $id_detail_jadwal_kuliah;

    /**
     *
     * @var integer
     * @Column(column="id_users", type="integer", length=11, nullable=false)
     */
    public $id_users;

    /**
     *
     * @var integer
     * @Column(column="id_jadwal_kuliah", type="integer", length=11, nullable=false)
     */
    public $id_jadwal_kuliah;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("detail_jadwal_kuliah");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'detail_jadwal_kuliah';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetailJadwalKuliah[]|DetailJadwalKuliah|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return DetailJadwalKuliah|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
