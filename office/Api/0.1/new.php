<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC9uZXcucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
    Authorization::init(1);
$tabel="appoffice";
$keywords="nama,keyid,categori,nmtabel,fileType,filename,setQuery";
//$chart=tatiye::chart("appoffice","index");
//$chartMonth=tatiye::chartMonth("appoffice","index",$chart);
$COUNT=tatiye::fetch("appoffice"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        *
        FROM appoffice
        WHERE row='1'  $search ORDER BY id DESC ".$data["record"];
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
  $no=$no+1;
     // $newToken=tatiye::WJT([
     //    'key'   =>$row["id"], 
     //  ]);

  $Expuid=tatiye::fetchUserID($row["userid"]);
  $number=array("no"=>$no);
    $sub_array["appid"] = tatiye::uidSSL($row["id"]);          
    $sub_array["title"] =$row["nama"];        
    $sub_array["type"] =$row["fileType"];  
    $sub_array["username"] =$Expuid["name"];  
    $sub_array["date"] =$row["date"];  
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
