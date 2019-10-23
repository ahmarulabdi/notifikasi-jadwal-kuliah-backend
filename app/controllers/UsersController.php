<?php
define("FIREBASE_SERVER_TOKEN","AAAApdn9yTQ:APA91bHS3aavIbxJphWX0skKwd1xQ8O-ll0AyMIW3y6U6Bbu3srrS9QJsy9TfJXrr-xK8sxq4yha48NvoRJXdRZLgiK0GnAx039DC0U1JqmSS3d-bWoUyDdnKUD3dzsTmjFA1EnQRUcJ");

class UsersController extends \Phalcon\Mvc\Controller
{

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $nip_nim = $post['nip_nim'];
            $password = md5($post['password']);
            $instance_id = $post['instance_id'];

            $users = Users::findFirstByNipNim($nip_nim);
            if ($users) {
                if ($users->password == $password) {
                    $firebase_token = new FirebaseToken();
                    $firebase_token->assign([
                        'id_users' => $users->id_users,
                        'instance_id' => $instance_id
                    ]);

                    if ($firebase_token->save()) {

                        if ($users->hak_akses == 'mahasiswa') {
                            $detail_mata_kuliahs = DetailJadwalKuliah::find([
                                'conditions' => "id_users = $users->id_users"
                            ]);



                            foreach ($detail_mata_kuliahs as $detail_mata_kuliah) {
                                $url = 'https://iid.googleapis.com/iid/v1:batchAdd';
                                //$url = "https://iid.googleapis.com/iid/v1:batchRemove";
                                $fields['registration_tokens'] = array($instance_id);
                                $fields['to'] = '/topics/'.$detail_mata_kuliah->id_jadwal_kuliah;
                                $headers = array(
                                    'Content-Type:application/json',
                                    'Authorization:key='.FIREBASE_SERVER_TOKEN
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

                            }
                        }


                        return JSON::set([
                            'status' => true,
                            'data' => $users,
                            'message' => "login berhasil"
                        ]);
                    } else {
                        return JSON::set([
                            'status' => false,
                            'data' => null,
                            'message' => "login gagal"
                        ]);
                    }
                } else {
                    return JSON::set([
                        'status' => false,
                        'data' => null,
                        'message' => "login gagal, password salah"
                    ]);
                }
            } else {
                return JSON::set([
                    'status' => false,
                    'data' => null,
                    'message' => "login gagal, data yang anda masukkan salah"
                ]);
            }
        }

    }

    public function logoutAction()
    {
        if ($this->request->isPost()) {
            $post = $this->request->getPost();


            $fb_token = FirebaseToken::findFirstByInstanceId($post['instance_id']);

            $users = Users::findFirstByIdUsers($post['id_users']);

//            if ($users->hak_akses == 'mahasiswa') {
//                $detail_mata_kuliahs = DetailJadwalKuliah::find([
//                    'conditions' => "id_users = $users->id_users"
//                ]);

//                foreach ($detail_mata_kuliahs as $detail_mata_kuliah) {
////                    $url = 'https://iid.googleapis.com/iid/v1:batchAdd';
//                    $url = "https://iid.googleapis.com/iid/v1:batchRemove";
//                    $fields['registration_tokens'] = array($fb_token->instance_id);
//                    $fields['to'] = '/topics/'.$detail_mata_kuliah->id_jadwal_kuliah;
//                    $headers = array(
//                        'Content-Type:application/json',
//                        'Authorization:key='.FIREBASE_SERVER_TOKEN
//                    );
//                    $ch = curl_init();
//                    curl_setopt($ch, CURLOPT_URL, $url);
//                    curl_setopt($ch, CURLOPT_POST, true);
//                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//                    $result = curl_exec($ch);
//                    curl_close($ch);
//
//                }
//            }

            if ($fb_token) {
                $fb_token->delete();
                return JSON::set(
                    [
                        'status' => true,
                        'mesage' => 'berhasil logout',
                        'data' => null
                    ]
                );
            }
        }
    }

}

