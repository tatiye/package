<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$Text=tatiye::Text();
$NEWTOKEN="eyJkaXIiOiJiaWxpbmdcL0FwaVwvMC4xXC9iaWxPcmRlci5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        *,
        SUM(harga) AS totharga,
        SUM(jumlah) AS totjumlah
        FROM biling
        WHERE userid='".tatiye::uidkey()."' AND (status IS NULL OR status NOT IN ('Paid')) GROUP BY order_id ORDER BY id DESC";
$COUNT=tatiye::fetch("biling"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);    

  /*
|--------------------------------------------------------------------------
| Initializes item 
|--------------------------------------------------------------------------
| Develover Tatiye.Net 2022
| @Date  
*/
function item($key){
    $str='';
    $resultItems =tatiye::sqli("SELECT nama FROM salesitem WHERE idprice='".$key."'");
     while ($item = $resultItems->fetch_array()) {  
      $str=$str.'<li>'.$item['nama'].'</li>';
    } 
     return '<ol>'.$str.'</ol>';  
}
/* and class item */

  

  while ($row = $variable->fetch()) {                                   
    $number=$number+1;  
     $Expuid=tatiye::fetchUserIDTabel($row["userid"]);         
      if (!empty($row["status"])) {
      $sts=$row["status"];
     } else {
      $sts='Unpaid';
     }                                           
    $sub_array = array();                                               
    $sub_array[] =$number;                                    
    $sub_array[] ='
       <dt>ID: '.tatiye::idOorder("TN",$row["id"],$row["date"]).'</dt> 
       <dd >'.tatiye::Ft('HTGL',$row["date"]).'</dd> 
     ';                                       
    $sub_array[] =$row["deskripsi"]??='Unpaid';                                         
    $sub_array[] =$row["totjumlah"];                                         
    // $sub_array[] =$Text->numberFormat([$row["totharga"],0]) ;                                        
    $sub_array[] =$Text->numberFormat([($row["totharga"]),0]);                                        
    $sub_array[] =$row["id"];                                            
                  
    array_push($products_arr["data"],array_merge($sub_array,$Expuid));  
  }                                                                     
  $merge=array(                                                         
    "draw"               =>$COUNT["count"],                             
    "recordsTotal"       =>0,                                           
    "recordsFiltered"    =>0,                                           
  );                                                                    
  $json_arr=array_merge($merge,$products_arr);                          
  echo json_encode($json_arr);                                          
} else {
  return tatiye::index();
}
