<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJwb3J0Zm9saW9cL0FwaVwvMC4xXC9zZWxlY3Rwb3J0by5waHAiLCJ1aWQiOjF9";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="portfolio";
$keywords="nama,title,deskripsi,id,userid";
//$chart=tatiye::chart("portfolio","index");
//$chartMonth=tatiye::chartMonth("portfolio","index",$chart);
$COUNT=tatiye::fetch("portfolio"," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        nama,title,deskripsi,id,userid 
        FROM portfolio
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
  $no=$no+1;
  $IMGS= tatiye::fetch('appfile','filename,date',"keyid='".$row['id']."' AND nmtabel='portfolio' AND categori='images' ORDER BY id DESC");


  $filename=tatiye::fileimg([$row['id'],'portfolio','80x80']);
  $Expuid=tatiye::fetchUserID($row["userid"]);
  $number=array("no"=>$no);
    $sub_array["Logo"] =$filename;            
    $sub_array["nama"] =$row["nama"];            
    $sub_array["title"] =$row["title"];          
    $sub_array["deskripsi"] =$row["deskripsi"];  
    $sub_array["id"] =$row["id"];                
    $sub_array["userid"] =$row["userid"];        
  array_push($products_arr["storage"], array_merge($number,$sub_array,$Expuid));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
