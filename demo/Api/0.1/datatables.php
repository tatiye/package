<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZW1vXC9BcGlcLzAuMVwvZGF0YXRhYmxlcy5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,title,id
        FROM demo
        WHERE row='1' LIMIT 30";
$COUNT=tatiye::fetch("demo"," COUNT(*) as count");
  $number=0;                                        
  $products_arr["data"]=array();                    
  $variable=tatiye::QY($QUERY);                     
  while ($row = $variable->fetch()) {               
    $number=$number+1;                              
    $sub_array = array();                           
    $sub_array[] =$number;                          
    $sub_array[] =$row["nama"];                     
    $sub_array[] =$row["title"];                    
    $sub_array[] =$row["id"];                    
    array_push($products_arr["data"], $sub_array);  
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
