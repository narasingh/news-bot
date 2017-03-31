<?php
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
  //$entityBody = file_get_contents('php://input');
  // Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function testLangID() {

     $siteurl = 'https://newsapi.org/v1/articles?source=google-news&sortBy=top&apiKey=17079e8f3fb24e55842030ff5783ef53';
     $curl = curl_init();
     $headers = array(
    'Accept: application/json',
    'Content-Type: application/json');

    //$ciroot = array("contentItems" => $ciarr);
    //$data_str = json_encode($ciroot);

     curl_setopt($curl, CURLOPT_URL, $siteurl);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     curl_setopt($curl, CURLOPT_USERPWD, "........:........");

     $result = curl_exec($curl);

     curl_close($curl);

     $decoded = json_decode($result, true);

     return $result;
}
$response = array(
  'color' => 'green',
  'message' => 'It\'s going to be sunny tomorrow!',
  'notify' => false,
  'message_format' => 'text'
);
echo json_encode($response, JSON_FORCE_OBJECT);
?>
