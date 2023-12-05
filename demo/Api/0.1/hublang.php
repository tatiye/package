<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZW1vXC9BcGlcLzAuMVwvaHVibGFuZy5waHAiLCJ1aWQiOjF9";
 Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,nsb,alamat
        FROM hublang
        WHERE row='1' ";
$COUNT=tatiye::fetch("hublang"," COUNT(*) as count");
  $number=0;                                        
  $products_arr["data"]=array();                    
  $variable=tatiye::QY($QUERY);                     
  while ($row = $variable->fetch()) {               
    $number=$number+1;                              
    $sub_array = array();                           
    $sub_array[] =$number;                          
    $sub_array[] =$row["nama"];                     
    $sub_array[] =$row["nsb"];                      
    $sub_array[] =$row["alamat"];                   
    array_push($products_arr["data"], $sub_array);  
  }                                                 
  $merge=array(                                     
    "draw"               =>$COUNT["count"],         
    "recordsTotal"       =>0,                       
    "recordsFiltered"    =>0,                       
  );                                                
  $json_arr=array_merge($products_arr);      
  echo json_encode($json_arr);                      
} else {
  return tatiye::index();
}
