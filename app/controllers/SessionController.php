<?php

class SessionController extends \Phalcon\Mvc\Controller
{

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $user = Users::findFirstByNipNim($post['nip_nim']);
            if ($user) {
                if ($user->password == md5($post['password'])) {
                    $this->session->set("users" ,$user);
                    $this->flashSession->success("berhasil login");
                    $this->response->redirect("webjadwalkuliah/data");
                }else{
                    $this->flashSession->warning("gagal login, password salah");
                    $this->response->redirect("");
                }
            } else {
                $this->flashSession->warning("data yang anda masukkan tidak ada");
                $this->response->redirect("");
            }
        }
    }
    public function logoutAction(){
        if ($this->request->isPost()){
            $this->session->remove("users");
            $this->response->redirect("");
        }
    }

}

