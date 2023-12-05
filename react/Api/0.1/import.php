<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJyZWFjdFwvQXBpXC8wLjFcL2ltcG9ydC5waHAiLCJ1aWQiOjF9";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="demo";
$keywords="nama,title,date,time";
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
$arry["update"]=tatiye::dt("DTIE");
$arry["total"] =$COUNT["count"];
$arry["data"]=array();
$QUERY="SELECT 
        id AS uid, nama,title,date,time
        FROM demo
        ORDER BY id DESC";
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
    array_push($arry["data"],$row);
}
 http_response_code(200);
    echo json_encode($arry); 
} else {
  return tatiye::index();
}
