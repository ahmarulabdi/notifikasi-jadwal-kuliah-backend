<?php



class WebjadwalkuliahController extends ControllerBase
{

    public function dataAction()
    {
        $jadwalkuliah = JadwalKuliah::find();
        $data = [];
        foreach ($jadwalkuliah as $item) {
            array_push($data, new JadwalKuliahAdd($item->id_jadwal_kuliah));
        }

        $this->view->setVars([
            'jadwal_kuliahs' => $data
        ]);
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            $kode = $post['kode'];
            $nama = $post['nama'];
            $sks = $post['sks'];
            $semester = $post['semester'];
            $tempat = $post['tempat'];
            $hari = $post['hari'];
            $jam_mulai = $post['jam_mulai'];
            $jam_selesai = $post['jam_selesai'];
            $nip = $post['nip'];

            $jadwal_kuliah = new JadwalKuliah();
            $jadwal_kuliah->assign([
                "kode" => $kode,
                "nama" => $nama,
                "sks" => $sks,
                "semester" => $semester,
                "tempat" => $tempat,
                "hari" => $hari,
                "jam_mulai" => $jam_mulai,
                "jam_selesai" => $jam_selesai,
                "nip" => $nip,
            ]);

            if ($jadwal_kuliah->save()) {
                $this->flashSession->success("jadwal kuliah berhasil dibuat");
                $this->response->redirect("webjadwalkuliah/data");
            } else {
                $this->flashSession->warning("jadwal kuliah gagal dibuat");
                $this->response->redirect("webjadwalkuliah/create");
            }


        }


        $dosen = Users::find([
            'conditions' => "hak_akses = 'dosen' "
        ]);

        $this->view->setVars([
            'dosens' => $dosen
        ]);

    }

    public function editAction($id_jadwal_kuliah)
    {
        $jadwal_kuliah = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);
        $dosen = Users::find([
            'conditions' => "hak_akses = 'dosen' "
        ]);
        $this->view->setVars([
            'jadwal_kuliah' => $jadwal_kuliah,
            'dosens' => $dosen
        ]);
    }

    public function updateAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();

            $id_jadwal_kuliah = $post['id_jadwal_kuliah'];
            $kode = $post['kode'];
            $nama = $post['nama'];
            $sks = $post['sks'];
            $semester = $post['semester'];
            $tempat = $post['tempat'];
            $hari = $post['hari'];
            $jam_mulai = $post['jam_mulai'];
            $jam_selesai = $post['jam_selesai'];
            $nip = $post['nip'];

            $jadwal_kuliah = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);


            $jadwal_kuliah->assign([
                "kode" => $kode,
                "nama" => $nama,
                "sks" => $sks,
                "semester" => $semester,
                "tempat" => $tempat,
                "hari" => $hari,
                "jam_mulai" => $jam_mulai,
                "jam_selesai" => $jam_selesai,
                "nip" => $nip,
            ]);

            if ($jadwal_kuliah->save()) {
                $this->flashSession->success("jadwal kuliah berhasil diperbarui");
                $this->response->redirect("webjadwalkuliah/data");
            } else {
                $this->flashSession->success("jadwal kuliah gagal diperbarui");
                $this->response->redirect("webjadwalkuliah/edit");
            }


        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()){
            $id_jadwal_kuliah= $this->request->getPost('id_jadwal_kuliah');
            $jadwal_kuliah = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);
            if ($jadwal_kuliah->delete()){
                $this->flashSession->success("jadwal kuliah berhasil dihapus");
            }else{
                $this->flashSession->success("jadwal kuliah gagal dihapus");
            }
            $this->response->redirect("webjadwalkuliah/data");
        }
    }
}

