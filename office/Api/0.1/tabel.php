<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC90YWJlbC5waHAiLCJ1aWQiOjF9";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$setUId=$_SESSION["user_id"];   
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
Authorization::init(1);
$row=tatiye::getWJT($val->appid);
$READ=tatiye::fetch("appoffice","setQuery","id='".tatiye::uidSSLKey($val->appid)."'");
$doc=json_decode($READ['setQuery']); 
http_response_code(200);
echo json_encode($doc);
} else {
  return tatiye::index();
}
