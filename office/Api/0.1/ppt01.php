<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\models\Package;
use app\models\storage;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC9wcHQwMS5waHAiLCJ1aWQiOjF9";
// Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "POST") {
$setUId=$_SESSION["user_id"];   
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
// $row=tatiye::getWJT($val->appid);
$READ=tatiye::fetch("appoffice","*","id='".tatiye::uidSSLKey($val->appid)."'");
$setTabel=Package::tabel();

$doc=json_decode($READ['setQuery']); 
       if(empty($READ['id'])) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          $response->addMessage("token tidak sesuai");
          $response->send();
          exit;
        }
      if(empty($val->tabel)) {
          $response = new Response();
          $response->setHttpStatusCode(400);
          $response->setSuccess(false);
          $response->addMessage("Pilih jenis tabel Office");
          $response->addMessage($setTabel);
          $response->send();
          exit;
        }
         $fetchKeys=tatiye::fetchKeys2($val->tabel);
http_response_code(200);
echo json_encode($fetchKeys);
} else {
  return tatiye::index();
}
