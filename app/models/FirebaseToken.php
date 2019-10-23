<?php

class FirebaseToken extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $id_users;

    /**
     *
     * @var string
     */
    public $instance_id;

    /**
     *
     * @var string
     */
    public $timestamp;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kuansing_uniks_notif_jadwal");
        $this->setSource("firebase_token");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'firebase_token';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return FirebaseToken[]|FirebaseToken|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return FirebaseToken|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }



}
