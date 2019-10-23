<?php

class Pengaturan extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id_pengaturan", type="integer", length=11, nullable=false)
     */
    public $id_pengaturan;

    /**
     *
     * @var string
     * @Column(column="isi", type="string", nullable=false)
     */
    public $isi;

    /**
     *
     * @var string
     * @Column(column="deskripsi", type="string", nullable=false)
     */
    public $deskripsi;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("pengaturan");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pengaturan';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pengaturan[]|Pengaturan|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pengaturan|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
