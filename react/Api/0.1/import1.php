<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$db=new tatiye();
$arry=array();
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
$arry['update']=tatiye::dt('DTIE');
$arry["total"] =$COUNT['count'];
$arry['data']=array();
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
