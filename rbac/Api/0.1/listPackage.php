<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJyYmFjXC9BcGlcLzAuMVwvbGlzdFBhY2thZ2UucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="appuserpackage";
$keywords="id,packageid,nama,namaBase,icon,deskripsi,userid";
$COUNT=tatiye::fetch("appuserpackage"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);

$IDuser= tatiye::fetch('appuserprofil','*',"id='".$val->userid."' ORDER BY id DESC");

$QUERY="SELECT 
        id,packageid,nama,namaBase,icon,deskripsi,userid
        FROM appuserpackage
        WHERE userid='".$IDuser['userid']."' $search ".$data["record"];
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
  $number=array("no"=>$no);
    $sub_array["id"] =$row["id"];                
    $sub_array["packageid"] =$row["packageid"];  
    $sub_array["nama"] =$row["nama"];            
    $sub_array["namaBase"] =$row["namaBase"];    
    $sub_array["icon"] =$row["icon"];            
    $sub_array["deskripsi"] =$row["deskripsi"];  
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
