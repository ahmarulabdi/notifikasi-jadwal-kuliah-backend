<?php
/**
 * Created by PhpStorm.
 * User: rndmjck
 * Date: 29/07/18
 * Time: 23:27
 */



use Phalcon\Http\Response;

class JSON
{
    /**
     * @param array $arr format php
     * @return Response format dengan header JSON
     */
    public static function set($arr = []){
        return (new Response())->setJsonContent($arr);
    }
}