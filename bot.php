<?php
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
$postdata = json_decode(file_get_contents("php://input"), true);
$action = '';
$data = $postdata['item'];
$message = $data['message']['message'];
$userName = $data['message']['from']['name'];
$userId = $data['message']['id'];

function getHelp() {
  $usages = 'Usage: \n';
  $usages .= '/timely                                                print this help message \n';
  $usages .= '/timely :week                                          show the clarity entered by the user for the current week \n';
  $usages .= '/timely :day                                           show the clarity entered by the user for the current week \n';
  $usages .= '/timely :project-id :hours-minutes :message            submit clarity for the day \n';
  $usages .= '/timely :date :project-id :hours-minutes :message      submit clarity for particular date \n';

 return array(
    'color' => 'gray',
    'message' => $usages
  );
}
function afterInsert() {

  global $userName;
  global $userId;

  $description = $userName. ' '. ' has submitted his timesheet';

  $response = array(
    "color" => "green",
    "style" => "application",
    "format" => "medium",
    "id" => $userId,
    "title" => "Timely",
    "description" => $description,
    "icon" =>  array(
      "url" => "http://bit.ly/1S9Z5dF"
    ),
    "attributes" => array(
      array(
        "label" => "first project",
        "value" => array(
          "label" => "description and hours"
        )
      ),
      array(
        "label" => "second project",
        "value" => array(
          "icon" => array(
            "url" => "http://bit.ly/1S9Z5dF"
          ),
          "label" => "description and hours",
          "style" => "lozenge-complete"
        )
      )
    )  
  );

/*
  $response = array(
    "color" => "green",
    "card" => array(
      "style" => "link",
      "url" => 'http://i0.kym-cdn.com/photos/images/newsfeed/000/131/786/tumblr_ljkeuyjp1a1qafrh6.gif',
      "id" => "fee4d9a3-685d-4cbd-abaa-c8850d9b1960",
      "title" => 'TIMELY',
      "description" => $description,
      "date" => time(),
      "thumbnail" => array(
        "url" => 'https://c.martech.zone/wp-content/uploads/2010/06/example-logo.png',
        "url@2x" => 'https://c.martech.zone/wp-content/uploads/2010/06/example-logo.png',
        "width" => 1193,
        "height" => 564
      )
    ),
    'message' => "test",
    "message_format" => 'html'
  );
  */

  return $response;
}

//this method is only for hipchat bot
function effortByChatBot($type) {

  $response = array();

  switch($type) {
    default:
        $response = afterInsert();
    break;
  }
  return json_encode($response, JSON_FORCE_OBJECT);
}

try{

  echo effortByChatBot('help');

}catch(Exception $e) {
  echo 'Caught Exception, ',$e->getMessage(),'\n';
}


?>
