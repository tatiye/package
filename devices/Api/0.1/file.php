<?php
error_reporting(0);
use app\tatiye;
$Text=tatiye::Text();
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvZmlsZS5waHAiLCJ1aWQiOjF9";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="appfile";
$keywords="keyid,categori,nmtabel,fileType,filename,nama,id";

$setUId=$_SESSION['user_id'] ;
if ($setUId==1) {
   $setRow="row='1'  AND categori !='Profil'  ";
} else {
   $setRow="userid='".$setUId."'  AND categori !='Profil'  ";
}

$COUNT=tatiye::fetch("appfile"," COUNT(*) as count",$setRow);
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);


$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        *
        FROM appfile
        WHERE $setRow $search ORDER BY id DESC ".$data["record"];
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
   if (!empty($row["nama"])) {

  $no=$no+1;
  $id=$row["keyid"];
  $fetchKeys=tatiye::fetchKeys($row["nmtabel"]);
   $tbl= tatiye::fetch($row["nmtabel"],$fetchKeys[0],"id=$id");

   $Expuid=tatiye::fetchUserID($row["userid"]);
   if (!empty($tbl[$fetchKeys[0]])) {
     $nmFile=$tbl[$fetchKeys[0]];
   } else {
     $nmFile='Noname';
   }
   if ($row["fileType"]=='png') {
      $icon='tx-orange far fa-file-image';
   } else if ($row["fileType"]=='jpg') {
      $icon='tx-purple far fa-file-image';
   } else if ($row["fileType"]=='docx') {
      $icon='tx-primary far fa-file-word'; 
   } else if ($row["fileType"]=='xlsx') {
      $icon='tx-success far fa-file-excel';
   } else if ($row["fileType"]=='jpeg') {
     $icon='tx-purple far fa-file-image';
   } else {
     $icon='tx-danger far fa-file-pdf';
   }
        $number=array("no"=>$no);
          $sub_array["icon"]     =$icon;        
          $sub_array["keyid"]    =$row["row"];        
          $sub_array["keyid"]    =$row["keyid"];        
          $sub_array["nama"]     =$row["nama"];  
          $sub_array["nmtabel"]  =$row["nmtabel"];    
          $sub_array["type"]     =$row["fileType"];  
          $sub_array["file"]     =$row["filename"];  
          $sub_array["id"]       =$row["id"];  
          $sub_array["nmFile"]   =$Text->substr([$row["nama"],0,20]);  
          $sub_array["date"]     =tatiye::Ft('HTGL',$row["date"]);  
          $sub_array["time"]     =$row["time"];  
        array_push($products_arr["storage"], array_merge($number,$sub_array,$Expuid));
      }
   }
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
