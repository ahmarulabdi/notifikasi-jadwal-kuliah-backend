<?php

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id_users", type="integer", length=11, nullable=false)
     */
    public $id_users;

    /**
     *
     * @var integer
     * @Column(column="nip_nim", type="integer", length=50, nullable=false)
     */
    public $nip_nim;

    /**
     *
     * @var string
     * @Column(column="password", type="string", nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(column="nama", type="string", length=100, nullable=false)
     */
    public $nama;

    /**
     *
     * @var string
     * @Column(column="hak_akses", type="string", nullable=false)
     */
    public $hak_akses;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("users");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
