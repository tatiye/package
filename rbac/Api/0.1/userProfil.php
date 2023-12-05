<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJyYmFjXC9BcGlcLzAuMVwvdXNlclByb2ZpbC5waHAiLCJ1aWQiOjF9";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="appuserprofil";
$keywords="id,nama,email,password,telepon,alamat,avatar,mapId";
$COUNT=tatiye::fetch("appuserprofil"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        id,nama,email,password,telepon,alamat,avatar,mapId
        FROM appuserprofil
        WHERE id='".$val->userid."' $search ".$data["record"];
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
  if (!empty($row["avatar"])) {
        $filename=tatiye::LINK('images/'.$row["avatar"]);
      } else {
        $filename=tatiye::LINK('images/profil/admin.jpeg');
      }  
  $number=array("no"=>$no);
    $sub_array["id"] =$row["id"];              
    $sub_array["nama"] =$row["nama"];          
    $sub_array["email"] =$row["email"];        
    $sub_array["password"] =$row["password"];  
    $sub_array["telepon"] =$row["telepon"];    
    $sub_array["alamat"] =$row["alamat"];      
    $sub_array["avatar"] =$filename;      
    $sub_array["mapId"] =$row["mapId"];        
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
