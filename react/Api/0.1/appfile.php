<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJyZWFjdFwvQXBpXC8wLjFcL2FwcGZpbGUucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="demo";
$keywords="nama,title,id,date,time";
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        nama,title,id,date,time
        FROM demo
        WHERE row='1' $search ".$data["record"];
$no=0;
$products_arr["limit"]        =$val->limit;
$products_arr["page"]         =$val->page;
$products_arr["total_data"]   =$COUNT["count"];
$products_arr["keywords"]     =$val->page;
$products_arr["total_peging"] =$total_paging;
$products_arr["storage"]      =array();
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
  $no=$no+1;
  $id=$row["id"];
  $img= tatiye::fetch("appfile","*","keyid=$id ORDER BY id DESC");
  if (!empty($img["filename"])) {

    if ($img["categori"]=='drive') {
      $filename=tatiye::setfileType($img["fileType"]);
      $date=$img["date"].", ".$img["time"];
    } else {
      $filename=tatiye::LINK($img["filename"]);
      $date=$img["date"].", ".$img["time"];
    }
    
  } else {
    $filename=tatiye::LINK("images/collections.svg");
    $date=$row["date"].", ".$row["time"];
 }
  $number=array("no"=>$no);
    $sub_array["nama"] =$row["nama"];    
    $sub_array["title"] =$row["title"];  
    $sub_array["id"] =$row["id"];        
    $sub_array["date"] =$row["date"];    
    $sub_array["time"] =$row["time"];    
    $sub_array["date"]     =$date;  
    $sub_array["filename"] =$filename;
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
