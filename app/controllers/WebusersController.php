<?php

class WebusersController extends ControllerBase
{

    public function dataAction()
    {
        $users = Users::find();
        $this->view->setVars([
            'users' => $users
        ]);
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();


            $user = new Users();

            $user->assign([
                'nama' => $post['nama'],
                'nip_nim' => $post['nip_nim'],
                'hak_akses' => $post['hak_akses'],
                'password' => md5($post['nip_nim'])
            ]);

            if ($user->save()) {
                $this->flashSession->success("data users $user->nnama berhasil ditambah");
                $this->response->redirect("webusers/data");
            } else {
                $this->flashSession->error("data users $user->nnama gagal ditambah");
                $this->response->redirect("webusers/data");
            }
        }
    }

    public function updateAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $user = Users::findFirstByIdUsers($post['id_users']);

            $user->assign([
                'nama' => $post['nama'],
                'nip_nim' => $post['nip_nim'],
                'hak_akses' => $post['hak_akses'],
            ]);


            if ($user->save()) {
                $this->flashSession->success("data users $user->nnama berhasil diperbarui");
                $this->response->redirect("webusers/data");
            } else {
                $this->flashSession->error("data users $user->nnama gagal diperbarui");
                $this->response->redirect("webusers/data");
            }
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $users = Users::findFirstByIdUsers($post['id_users']);
            if ($users->delete()) {
                $this->flashSession->success("data user berhasil dihapus");
                $this->response->redirect("webusers/data");
            } else {
                $this->flashSession->error("data user gagal dihapus");
                $this->response->redirect("webusers/data");
            }
        }
    }

    public function detailMakulAction($id_users)
    {
        $data = DetailJadwalKuliah::find([
            'conditions' => "id_users = $id_users"
        ]);

        $detailmakuls = [];

        foreach ($data as $item) {
            array_push($detailmakuls, [
                'id_detail_jadwal_kuliah' => $item->id_detail_jadwal_kuliah,
                'data' => new JadwalKuliahAdd($item->id_jadwal_kuliah)
            ]);
        }


        $users = Users::findFirstByIdUsers($id_users);


        $this->view->setVars([
            'detailmakuls' => $detailmakuls,
            'users' => $users
        ]);
    }
    public function dosenMakulAction($nip)
    {
        $jadwal_kuliahs = JadwalKuliah::find([
           'conditions' => "nip = $nip"
        ]);




        $jadwal_kuliah_dosens = [];
        foreach ($jadwal_kuliahs as $jadwal_kuliah) {
            array_push($jadwal_kuliah_dosens,new JadwalKuliahAdd($jadwal_kuliah->id_jadwal_kuliah));
        }

        $this->view->setVars([
            'jadwal_kuliah_dosens' => $jadwal_kuliah_dosens
        ]);
    }

    public function deleteMakulKRSAction()
    {
        if ($this->request->isPost()) {

            $id_detail = $this->request->getPost('id_detail_jadwal_kuliah');
            $id_users = $this->request->getPost('id_users');

            $detail = DetailJadwalKuliah::findFirstByIdDetailJadwalKuliah($id_detail);


            if ($detail->delete()) {
                $this->flashSession->success("hapus jadwal kuliah di KRS ini berhasil");
                $this->response->redirect("webusers/detailmakul/$id_users");
            } else {
                $this->flashSession->error("hapus jadwal kuliah di KRS ini gagal");
                $this->response->redirect("webusers/detailmakul/$id_users");
            }
        }
    }

}

