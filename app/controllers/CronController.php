<?php
/**
 * Created by PhpStorm.
 * User: adryanev
 * Date: 8/31/2018
 * Time: 11:02 PM
 */
define('FIREBASE_SERVER_TOKEN',"AAAApdn9yTQ:APA91bHS3aavIbxJphWX0skKwd1xQ8O-ll0AyMIW3y6U6Bbu3srrS9QJsy9TfJXrr-xK8sxq4yha48NvoRJXdRZLgiK0GnAx039DC0U1JqmSS3d-bWoUyDdnKUD3dzsTmjFA1EnQRUcJ");

class CronController extends Phalcon\Mvc\Controller
{

    public function getusersAction(){

        $today = date('D');
        $urutanHari = '';
        switch ($today){
            case 'Sun':
                $urutanHari = "minggu";
                break;
            case 'Mon':
                $urutanHari = "senin";
                break;
            case 'Tue':
                $urutanHari = "selasa";
                break;
            case 'Wed':
                $urutanHari = "rabu";
                break;
            case 'Thu':
                $urutanHari = "kamis";
                break;
            case "Fri":
                $urutanHari = "jumat";
                break;
            case 'Sat':
                $urutanHari = "sabtu";
                break;
            default:
                $urutanHari = '';
                break;
        }
        $users = Users::find([
            'conditions'=> "hak_akses = 'mahasiswa'"
        ]);

        foreach ($users as $user){
            $query = $this->modelsManager->createQuery("
            SELECT DetailJadwalKuliah.id_jadwal_kuliah, JadwalKuliah.nama, JadwalKuliah.jam_mulai, JadwalKuliah.tempat from JadwalKuliah INNER JOIN DetailJadwalKuliah on DetailJadwalKuliah.id_jadwal_kuliah = JadwalKuliah.id_jadwal_kuliah where id_users = $user->id_users and JadwalKuliah.hari = '$urutanHari'");
            $execute = $query->execute();

            
            $teks_awal = "Jadwal kuliah $urutanHari:\n";

            foreach ($execute as $jadwal){


                $string_makul = "$jadwal->jam_mulai -> $jadwal->nama ($jadwal->tempat)\n";
                $teks_awal.=$string_makul;
            };

            $token = FirebaseToken::findFirstByIdUsers($user->id_users);
            
            $instanceId = $token->instance_id;

            $payload = array(
                'to'=>$instanceId,
                'priority'=>'high',
                "mutable_content"=>true,
                "notification"=>array(
                    "title"=> 'Jadwal Hari Ini',
                    "body"=> $teks_awal
                ),

            );
            $headers = array(
                'Authorization:key='.FIREBASE_SERVER_TOKEN,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $payload ) );
            $result = curl_exec($ch );
            curl_close( $ch );



        }

    }


}
