<?php
use app\tatiye;
use app\models\storage;
$NEWTOKEN="eyJkaXIiOiJyZWFjdFwvQXBpXC8wLjFcL3BsYWNlaG9sZGVyLnBocCIsInVpZCI6MX0";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="applaceholder";
$keywords="id,title";
$COUNT=tatiye::fetch("applaceholder "," COUNT(*) as count");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        *
        FROM applaceholder 
        WHERE row='1' $search ORDER BY id DESC ".$data["record"];
$no=0;
$products_arr["limit"]        =$val->limit;
$products_arr["page"]         =$val->page;
$products_arr["total_data"]   =$COUNT["count"];
$products_arr["keywords"]     =$val->keywords;
$products_arr["total_peging"] =$total_paging;
$products_arr["storage"]      =array();
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
  $no=$no+1;
  $number=array("no"=>$no);
    $sub_array["id"] =$row["id"];          
    $sub_array["segment"] =$row["segment"];          
    $sub_array["web"] =$row["web"];                  
    $sub_array["favicons"] =$row["favicons"];        
    $sub_array["thumbnail"] =tatiye::LINK($row["thumbnail"]);      
    $sub_array["link"] =$row["link"];                
    $sub_array["title"] =$row["title"];              
    $sub_array["description"] =$row["description"];  
    $sub_array["pubDate"]  =$row["pubDate"];          
    $sub_array["categori"] =$row["categori"];        
  array_push($products_arr["storage"], array_merge($number,$sub_array));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
