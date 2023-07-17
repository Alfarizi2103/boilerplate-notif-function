<?php
defined('BASEPATH') or exit('No direct script access allowed');

function sendNotif($to, $notif, $data)
{
    // Firebase API key
    // $apiKey = "AAAAxjOAMxk:APA91bEg7h9V3jKO7rCV0f_pMmNcumDipB5kLzjVhXHBRIr-dEtxq7byW7p3rrL6Ktux1u8kXgakvkGCNk4fsyitCHYM5-M8nv1Qjd9GgoydHAHjujK5n52u16pRzCVKvLh-rObmtCuV";
    $apiKey = "AAAA7RYKVbo:APA91bEsPMiTr0OJ0XL9D2GLUPEcilcCMGO07qFa_mPTE0iPvrpTZkKZ176DjAaaivtJ7YGKmYUuaCrL8wtqwyjSxQ6bCDUzcV2o_qUAnQGXrN5CUNleINiDdOT9SiSgeI5xvtUyVQzV";

    // Set up curl
    $ch = curl_init();
    $url = "https://fcm.googleapis.com/fcm/send";
    $fields = json_encode(array('to' => $to, 'notification' => $notif, 'data' => $data));

    // Set curl options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    // Set headers
    $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Execute request
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }
    curl_close($ch);

    return $result;
}

//use fcm token or topics
$to = '/topics/content';
//$to = 'cjrq4KQ0oT3r_e-LF3trc6:APA91bHsIUFldCCpVZlK5x13xX04ijQfcaIPL_ECEVVghTyxPXMq_5euyqvr7pX_wB-EB2mpEjoILS4uijCZCo4zbfkvpjcXfcdFWlw5sbp9rIlR3YJLK9jwhWa5F7LVrIfg9o93COiu';

sendNotif($to, 'New Message', 'Kaching, new message');
