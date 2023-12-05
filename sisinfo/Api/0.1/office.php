<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$Text=tatiye::Text();
$NEWTOKEN="eyJkaXIiOiJzaXNpbmZvXC9BcGlcLzAuMVwvb2ZmaWNlLnBocCIsInVpZCI6MX0";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="sisinfo";
$keywords="nama,deskripsi,date,time,id";
$COUNT=tatiye::fetch("sisinfo"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        * 
        FROM sisinfo
        WHERE row='1' $search ORDER BY id DESC ".$data["record"];
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
  $DTX= tatiye::fetch('format','nmfile',"deskripsi='".$row["deskripsi"]."' ");
  $no=$no+1;
  $Expuid=tatiye::fetchUserID($row["userid"]);

  $number=array("no"=>$no);
    $sub_array["nama"] =$row["nama"];    
    $sub_array["deskripsi"] =$row["deskripsi"];  
    $sub_array["format"] =$row["format"];  
    $sub_array["date"] =$row["date"];    
    $sub_array["time"] =$row["time"];    
    $sub_array["id"] =$row["id"];        
    $sub_array["nmfile"] =$Text->strreplace([$DTX["nmfile"],'_',' ']);        
  array_push($products_arr["storage"], array_merge($number,$sub_array,$Expuid));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
