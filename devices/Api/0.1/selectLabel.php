<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvc2VsZWN0TGFiZWwucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="apparchive";
$keywords="nama";
//$chart=tatiye::chart("apparchive","index");
//$chartMonth=tatiye::chartMonth("apparchive","index",$chart);
$COUNT=tatiye::fetch("apparchive"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);

 $setUId=$_SESSION['user_id'] ;
 $setRow="userid='".$setUId."' ";

  if (!empty($val->primaryKey)) {
   $categori='label_'.$val->primaryKey;
 } else {
   $categori='archive';
 }


$QUERY="SELECT *
    FROM apparchive
    WHERE 
    $setRow AND categori='".$categori."' 
    AND package !='office' 
    GROUP BY package 
    ORDER BY id DESC ".$data["record"];

$QUERY2="SELECT *
    FROM apparchive
    WHERE 
    $setRow AND categori='".$categori."' 
    AND package ='office' $search 
    ORDER BY id DESC ".$data["record"];



$record_num = ($val->limit * $val->page) - $val->limit;
$no=$record_num;
$products_arr["limit"]        =$val->limit;
$products_arr["page"]         =$val->page;
$products_arr["total_data"]   =$COUNT["count"];
$products_arr["keywords"]     =$val->page;
$products_arr["total_peging"] =$total_paging;
$products_arr["storage"]      =array();
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
    if ($row["fileType"]=='xlsx') {
         $icon='tx-success far fa-file-excel';
    } else {
        $icon='tx-gray-600 far fa-file-alt';
    }
  $no=$no+1;
  $number=array("no"=>$no);
    $sub_array["nama"] =$row["nama"];            
    $sub_array["package"] =$row["package"];                    
    $sub_array["date"] =$row["date"];    
    $sub_array["icon"] =$icon;    
    $sub_array["time"] =$row["time"];    
    $sub_array["id"] =$row["id"];    
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$result=$db->query($QUERY2);
 while($row=$result->fetch_assoc()){
  $no=$no+1;
  if ($row["fileType"]=='png') {
       $icon='tx-orange far fa-file-image';
    } else if ($row["fileType"]=='jpg') {
       $icon='tx-purple far fa-file-image';
    } else if ($row["fileType"]=='docx') {
       $icon='tx-primary far fa-file-word'; 
    } else if ($row["fileType"]=='ppt') {
       $icon='tx-orange far fa-file-powerpoint';
    } else if ($row["fileType"]=='xlsx') {
       $icon='tx-success far fa-file-excel';
    } else {
      $icon='tx-danger far fa-file-pdf';
    }
  $number=array("no"=>$no);
    $sub_array["nama"] =$row["nama"];            
    $sub_array["package"] =$row["package"];                    
    $sub_array["date"] =$row["date"];   
    $sub_array["icon"] =$icon;    
    $sub_array["fileType"] =$row["fileType"];    
    $sub_array["newToken"] =$row["newToken"];    
    $sub_array["time"] =$row["time"];    
    $sub_array["id"] =$row["id"];    
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
