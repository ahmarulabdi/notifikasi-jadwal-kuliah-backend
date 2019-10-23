<?php

class IndexController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function flagIsiKRSAction()
    {
        $pengaturan = Pengaturan::findFirstByIdPengaturan(1);
        $isi_krs = json_decode($pengaturan->isi);
        if ($isi_krs) {
            return JSON::set([
                'status' => true,
                'data' => $isi_krs,
                'message' => "berhasil cek pengisian"
            ]);
        } else {
            return JSON::set([
                'status' => false,
                'data' => null,
                'message' => "gagal cek pengisian"
            ]);
        }
    }

    public function setIsiKRSAction()
    {
        if ($this->request->isPost()) {
            $data['buka'] = $this->request->getPost("isi_buka");


            $pengaturan = Pengaturan::findFirstByIdPengaturan(1);
            $pengaturan->isi = json_encode($data);
            $isi_krs = json_decode($pengaturan->isi);

            if ($pengaturan->save()) {
                return JSON::set([
                    'status' => true,
                    'data' => $isi_krs,
                    'message' => "berhasil perbarui pengaturan isi krs"
                ]);
            } else {
                return JSON::set([
                    'status' => false,
                    'data' => null,
                    'message' => "gagal perbarui pengisian"
                ]);
            }

        }
    }


}

