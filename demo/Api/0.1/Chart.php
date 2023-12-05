<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
   $Text=tatiye::Text();

$NEWTOKEN="eyJkaXIiOiJkZW1vXC9BcGlcLzAuMVwvQ2hhcnQucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$tabel="demo";
$keywords="nama";
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
$chart=tatiye::chartTabel("demo",'date');
$chartMonth=tatiye::chartMonthTabel("demo",'date',$chart);
$data=storage::init($tabel)->Cook($val,$keywords,$val->keywords);
$search=storage::init($tabel)->keywords($keywords,$val->keywords);


$total_paging=storage::init($tabel)->total_paging($COUNT["count"],$val->limit,$keywords,$val->keywords);
$QUERY="SELECT 
        *
        FROM Hublang
        WHERE row='1' $search ORDER BY id DESC ".$data["record"];
$record_num = ($val->limit * $val->page) - $val->limit;
$no=$record_num;
$products_arr["limit"]        =$val->limit;
$products_arr["page"]         =$val->page;
$products_arr["total_data"]   =$Text->numberFormat([$COUNT['count'],0]);
$products_arr["description"]   =$Text->beCalculated([$COUNT['count'],'']);
$products_arr["keywords"]     =$val->page;
$products_arr["total_peging"] =$total_paging;
$products_arr["chartMonth"]    =$chartMonth;
$products_arr["chart"]        =$chart;
$products_arr["storage"]      =array();
$result=$db->query($QUERY);
 while($row=$result->fetch_assoc()){
  $no=$no+1;
  $Expuid=tatiye::fetchUserID($row["userid"]);
  $number=array("no"=>$no);
    $sub_array["nama"] =$row["nama"];                
    $sub_array["date"] =$row["date"];                              
  array_push($products_arr["storage"], array_merge($number,$sub_array,$Expuid));
}
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,$number);
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
