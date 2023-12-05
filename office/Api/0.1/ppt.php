<?php
error_reporting(0);
use app\tatiye;
use app\models\storage;
use app\tatiyeNetAuthorization AS Authorization;
 $Text=tatiye::Text();
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC9wcHQucGhwIiwidWlkIjoxfQ";
if($_SERVER["REQUEST_METHOD"] === "POST") {
  Authorization::init(1);
$val=json_decode(file_get_contents("php://input"));
$db=new tatiye();
$READ=tatiye::fetch("appoffice","*","id='".$val->primaryKey."'");
$tabel="appoffice";
$keywords="nama";

$chart=tatiye::chartTabel($READ['nmtabel'],$READ['keyid'],$READ['setWhere']);
$chartMonth=tatiye::chartMonthTabel($READ['nmtabel'],$READ['keyid'],$chart,$READ['setWhere']);
$COUNT=tatiye::fetch($READ['nmtabel']," COUNT(*) as count",$READ['setWhere']);
$products_arr["primaryKey"]   =$READ['nmtabel'];
$products_arr["total_data"]   =$Text->numberFormat([$COUNT['count'],0]);
$products_arr["description"]  =$Text->beCalculated([$COUNT['count'],'']);
$products_arr["chartMonth"]   =$chartMonth;
$products_arr["chart"]        =$chart;
$paging=storage::init($tabel)->getPaging($val->page,$COUNT["count"],$val->limit,array("no"=>1));
http_response_code(200);
echo json_encode(array_merge($products_arr,$paging));
} else {
  return tatiye::index();
}
