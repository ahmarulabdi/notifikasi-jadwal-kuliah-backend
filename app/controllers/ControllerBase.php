<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function initialize(){
        if (!$this->session->get("users")){
            $this->response->redirect("");
        }
    }
}
