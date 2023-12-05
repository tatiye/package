<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
 $Text=tatiye::Text();
$NEWTOKEN="eyJkaXIiOiJwb3N0aW5nYW5cL0FwaVwvMC4xXC9tb2JpbGVfaGlzdG9yLnBocCIsInVpZCI6MX0";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="appnews";
$keywords="id";
$COUNT=tatiye::fetch("appnews"," COUNT(*) as count","segment='Tatiye'");
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywordsId($keywords,$val->keywords);
$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        *
        FROM appnews
        WHERE segment IN('Tatiye') $search ORDER BY ascId  ".$data["record"];
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

  $Expuid=tatiye::thumbnail([$row['id'],'appnews','300x215']);
  $number=array("no"=>$no);
    $sub_array["segment"] =$row["segment"];          
    $sub_array["web"] =$row["web"];                  
    $sub_array["favicons"] =$row["favicons"];        
    $sub_array["thumbnail"] =tatiye::fileimg([$row['id'],'appnews','450x650']);      
    $sub_array["posts"] =tatiye::LINK('posts/'.$row["link"]);                
    $sub_array["title"] =$row["title"];              
    $sub_array["description"] =$row["description"];  
    $sub_array["detail"] =$row["detail"];  
    $sub_array["pubDate"] =$row["pubDate"];          
    $sub_array["dilihat"] =$row["dilihat"].'x';         
    $sub_array["lihat"] =$row["dilihat"];         
    $sub_array["categori"] =$row["categori"];        
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
