<?php
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
  //$entityBody = file_get_contents('php://input');
  // Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value
  function curl_get_contents($url)
  {
    $ch = curl_init();
    $timeout = 5;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $data = curl_exec($ch);

    curl_close($ch);

    return json_decode($data);
  }

$url="https://newsapi.org/v1/articles?source=google-news&sortBy=top&apiKey=17079e8f3fb24e55842030ff5783ef53";
$contents = curl_get_contents($url);
$articles = $contents->articles[array_rand($contents->articles)];

$response = array(
  'color' => 'green',
  'message' => addslashes($articles->title),
  'card' => array(
    'style' => $articles->urlToImage
  ),
  'notify' => false,
  'message_format' => 'text'
);
echo json_encode($response, JSON_FORCE_OBJECT);
?>
