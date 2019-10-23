<?php
/**
 * Created by PhpStorm.
 * User: adryanev
 * Date: 8/31/2018
 * Time: 3:17 PM
 */

define('FIREBASE_SERVER_TOKEN', "AAAApdn9yTQ:APA91bHS3aavIbxJphWX0skKwd1xQ8O-ll0AyMIW3y6U6Bbu3srrS9QJsy9TfJXrr-xK8sxq4yha48NvoRJXdRZLgiK0GnAx039DC0U1JqmSS3d-bWoUyDdnKUD3dzsTmjFA1EnQRUcJ");

class NotifikasiController extends Phalcon\Mvc\Controller
{


    /**
     * Method ini akan mendapatkan instance_id dan id_users dari android, kemudian mendaftarkan nya ke database mysql
     */
    public function instanceidAction()
    {
        if ($this->request->isPost()) {
            $instance_id = $this->request->getPost('instance_id');
            $id_users = $this->request->getPost('id_users');

            $model = new FirebaseToken();
            $model->instance_id = $instance_id;
            $model->id_users = $id_users;
            $model->save();


        }
    }

    public function updateinstanceidAction()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getPost('id_users');
            $newToken = $this->request->getPost('instance_id');
            $model = FirebaseToken::findFirstByIdUsers($id);
            $model->instance_id = $newToken;
            $model->save();

        }
    }

    public function insertnotifAction()
    {

        if ($this->request->isPost()) {
            $matkul = $this->request->getPost('id_jadwal_kuliah');

            $pesan = $this->request->getPost('pesan');
            $namaMatakuliah = JadwalKuliah::findFirstByIdJadwalKuliah($matkul);

            $payload = array(
                'to' => '/topics/' . $matkul,
                'priority' => 'high',
                "mutable_content" => true,
                "notification" => array(
                    "title" => 'Info Matkul ' . $namaMatakuliah->nama,
                    "body" => $pesan
                ),

            );
            $headers = array(
                'Authorization:key=' . FIREBASE_SERVER_TOKEN,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            $result = curl_exec($ch);
            curl_close($ch);


            $notif_halangan = new NotifikasiHalangan();
            $notif_halangan->assign([
                'id_detail_jadwal_kuliah' => $matkul,
                'pesan' => $pesan,
            ]);

            if ($notif_halangan->save()) {
                return JSON::set([
                    'status' => true,
                    'message' => 'notifikasi tersimpan',
                    'data' => $notif_halangan
                ]);
            } else {
                return JSON::set([
                    'status' => false,
                    'message' => 'notifikasi gagal tersimpan',
                    'data' => null
                ]);
            }


        }
    }

    public function getNotificationUsersAction($id_users)
    {
        $detail_jadwals = DetailJadwalKuliah::findFirstByIdUsers($id_users);

        $query = $this->
        modelsManager->
        createQuery("SELECT NotifikasiHalangan.id_notifikasi,JadwalKuliah.nama,NotifikasiHalangan.pesan,NotifikasiHalangan.timestamp FROM NotifikasiHalangan INNER JOIN DetailJadwalKuliah ON NotifikasiHalangan.id_detail_jadwal_kuliah = DetailJadwalKuliah.id_jadwal_kuliah INNER JOIN Users ON DetailJadwalKuliah.id_users = Users.id_users INNER join JadwalKuliah ON JadwalKuliah.id_jadwal_kuliah = DetailJadwalKuliah.id_jadwal_kuliah WHERE Users.id_users = 3 ORDER  BY NotifikasiHalangan.id_notifikasi DESC limit 10");

        $execute = $query->execute();

        if (count($execute)) {
            return JSON::set([
                'status' => true,
                'message' => 'berhasil menampilkan notifikasi',
                'data' => $execute
            ]);
        }elseif (count($execute) == null) {
            return JSON::set([
                'status' => true,
                'message' => 'berhasil menampilkan notifikasi, notifikasi kosong',
                'data' => null
            ]);
        }
        else{
            return JSON::set([
                'status' => false,
                'message' => 'gagal menampilkan notifikasi',
                'data' => null
            ]);
        }



    }
}