<?php
include('lib/functions.php');
header('content-type: application/json');


if($_SERVER['REQUEST_METHOD']=="GET")
{
  if(isset($_GET['userlog']))
  {
    $id =  $_GET['userlog'];
    $json_user = get_all_user_profile();
    echo json_encode($json_user);
    $fp = fopen('users.json', 'w');
    fwrite($fp, json_encode($json_user));
    fclose($fp);
    if(empty($json))
    header("HTTP/1.1 404 Not Found");
    echo json_encode($json);
  }
  else{
    $json = get_all_user_list();
    echo json_encode($json);
    $fp = fopen('api.json', 'w');
    fwrite($fp, json_encode($json));
    fclose($fp);
  }
}


if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode( file_get_contents( 'php://input' ), true );
  
  $name = $data['name'];
  $email = $data['email'];
  
  $json = add_user_info($name,$email);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="PUT")
{
  $data = json_decode( file_get_contents( 'php://input' ), true );
  
  $id = $data['id'];
  $name = $data['name'];
  $email = $data['email'];
  
  $json = update_user_info($id,$name,$email);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="DELETE")
{
  $data = json_decode( file_get_contents( 'php://input' ), true );
  
  $id = $data['id'];
  
  $json = delete_user_info($id);
  echo json_encode($json);
}
?>