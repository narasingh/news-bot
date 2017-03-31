<?php
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");

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
  "color" => "gray",
  "card" => array(
    "style" => "link",
    "url" => $articles->url,
    "id" => "fee4d9a3-685d-4cbd-abaa-c8850d9b1960",
    "title" => $articles->title,
    "description" => $articles->description,
    "icon" => array(
      "url" => "http://bit.ly/1Qrfs1M"
    ),
    "date" => time(),
    "thumbnail" => array(
      "url" => $articles->urlToImage,
      "url@2x" => $articles->urlToImage,
      "width" => 1193,
      "height" => 564
    )
  ),
  'message' => "test",
  "message_format" => 'html'
);
echo json_encode($response, JSON_FORCE_OBJECT);
/*
echo '{
    "color": "gray",
    "card": {
              "style": "link",
              "url": "http://www.website.com/some-article",
              "id": "c253adc6-11fa-4941-ae26-7180d67e814a",
              "title": "Sample link card",
              "description": "This is some information about the link shared.\nin 2 lines of text",
              "icon": {
                "url": "http://bit.ly/1Qrfs1M"
              },
              "date": 1453867674631,
              "thumbnail": {
                "url": "http://bit.ly/1TmKuKQ",
                "url@2x": "http://bit.ly/1TmKuKQ",
                "width": 1193,
                "height": 564
              }
          },
    "message" : "test",
    "message_format" : "html"
}'
*/
?>
