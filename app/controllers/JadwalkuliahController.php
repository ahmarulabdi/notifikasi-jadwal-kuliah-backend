<?php

define("FIREBSE_SERVER_TOKEN","AAAApdn9yTQ:APA91bHS3aavIbxJphWX0skKwd1xQ8O-ll0AyMIW3y6U6Bbu3srrS9QJsy9TfJXrr-xK8sxq4yha48NvoRJXdRZLgiK0GnAx039DC0U1JqmSS3d-bWoUyDdnKUD3dzsTmjFA1EnQRUcJ");
class JadwalkuliahController extends \Phalcon\Mvc\Controller
{

    public function dataAction()
    {
        $jadwals = JadwalKuliah::find([
            'order' => 'urutan_hari ASC ,semester ASC'
        ]);
        $jadwalkuliahs = [];
        foreach ($jadwals as $jadwal) {
            array_push($jadwalkuliahs, new JadwalKuliahAdd($jadwal->id_jadwal_kuliah));
        }

        if (count($jadwals)) {
            return JSON::set([
                'status' => true,
                'data' => $jadwalkuliahs,
                'message' => "berhasil melihat jadwal kuliah"
            ]);
        } elseif (!count($jadwals)) {
            return JSON::set([
                'status' => true,
                'data' => null,
                'message' => "berhasil melihat jadwal kuliah, jadwal kuliah kosong"
            ]);
        } else {
            return JSON::set([
                'status' => false,
                'data' => null,
                'message' => "gagal melihat jadwal kuliah"
            ]);
        }
    }

    public function reviewKRSAction()
    {
        if ($this->request->isPost()) {
            $id_jadwal_kuliahs = $this->request->getPost("id_jadwal_kuliahs");

            $jadwalkuliahs = [];
            foreach ($id_jadwal_kuliahs as $id_jadwal_kuliah) {
                $temp = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);
                if (!empty($temp)) {
                    array_push($jadwalkuliahs, new JadwalKuliahAdd($temp->id_jadwal_kuliah));
                }
            }

            if (count($jadwalkuliahs)) {
                return JSON::set([
                    'status' => true,
                    'data' => $jadwalkuliahs,
                    'message' => "berhasil melihat jadwal kuliah"
                ]);
            } elseif (!count($jadwalkuliahs)) {
                return JSON::set([
                    'status' => true,
                    'data' => null,
                    'message' => "berhasil melihat jadwal kuliah, jadwal kuliah kosong"
                ]);
            } else {
                return JSON::set([
                    'status' => false,
                    'data' => null,
                    'message' => "gagal melihat jadwal kuliah"
                ]);
            }


        }
    }

    public function simpanKRSAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $id_users = $post['id_users'];
            $id_jadwal_kuliahs = $post['id_jadwal_kuliahs'];

            $fail_save = 0;
            $jadwal_kuliahs = [];
            foreach ($id_jadwal_kuliahs as $id_jadwal_kuliah) {
                $detail_jadwal = new DetailJadwalKuliah();
                $detail_jadwal->id_jadwal_kuliah = $id_jadwal_kuliah;
                $detail_jadwal->id_users = $id_users;
                $flag_save = $detail_jadwal->save();
                if ($flag_save) {
                    $temp = JadwalKuliah::findFirstByIdJadwalKuliah($id_jadwal_kuliah);
                    if ($temp) {
                        array_push($jadwal_kuliahs, new JadwalKuliahAdd($temp->id_jadwal_kuliah));
                    }

                        $token = FirebaseToken::findFirstByIdUsers($id_users);
                        $instance_id = $token->instance_id;

                    $url = 'https://iid.googleapis.com/iid/v1:batchAdd';
                    //$url = "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fields['registration_tokens'] = array($instance_id);
                    $fields['to'] = '/topics/'.$id_jadwal_kuliah;
                    $headers = array(
                        'Content-Type:application/json',
                        'Authorization:key='.FIREBSE_SERVER_TOKEN
                    );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result = curl_exec($ch);
                    curl_close($ch);


                } else {
                    $fail_save += 1;
                }
            }

            if ($fail_save == 0) {
                return JSON::set([
                    'status' => true,
                    'data' => null,
                    'message' => 'berhasil menyimpan mata kuliah pilihan anda'
                ]);
            } else {
                return JSON::set([
                    'status' => false,
                    'data' => null,
                    'message' => 'gagal menyimpan mata kuliah pilihan anda'
                ]);
            }


        }
    }

    public function jadwalMahasiswaAction($id_users)
    {
        $details = DetailJadwalKuliah::find([
            'conditions' => "id_users like $id_users",
        ]);

        $jadwal_kuliahs = [];
        foreach ($details as $detail) {
            array_push($jadwal_kuliahs, new JadwalKuliahAdd($detail->id_jadwal_kuliah));
        }

        if (count($details)) {
            return JSON::set([
                'status' => true,
                'data' => $jadwal_kuliahs,
                'message' => 'berhasil cek jadwal kuliah anda'
            ]);
        } elseif (!count($details)) {
            return JSON::set([
                'status' => true,
                'data' => null,
                'message' => 'berhasil cek jadwal kuliah anda, jadwal kosong'
            ]);
        } else {
            return JSON::set([
                'status' => false,
                'data' => null,
                'message' => 'ggagal cek jadwal kuliah anda'
            ]);
        }

    }

    public function jadwalDosenAction($nip)
    {
        $jadwals = JadwalKuliah::find([
            'conditions' => "nip = $nip",
            'order' => 'urutan_hari ASC ,semester ASC'
        ]);
        $jadwalkuliahs = [];
        foreach ($jadwals as $jadwal) {
            array_push($jadwalkuliahs, new JadwalKuliahAdd($jadwal->id_jadwal_kuliah));
        }

        if (count($jadwals)) {
            return JSON::set([
                'status' => true,
                'data' => $jadwalkuliahs,
                'message' => "berhasil melihat jadwal kuliah"
            ]);
        } elseif (!count($jadwals)) {
            return JSON::set([
                'status' => true,
                'data' => null,
                'message' => "berhasil melihat jadwal kuliah, jadwal kuliah kosong"
            ]);
        } else {
            return JSON::set([
                'status' => false,
                'data' => null,
                'message' => "gagal melihat jadwal kuliah"
            ]);
        }
    }

}

