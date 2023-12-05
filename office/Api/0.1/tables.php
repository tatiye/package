<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJvZmZpY2VcL0FwaVwvMC4xXC90YWJsZXMucGhwIiwidWlkIjoxfQ";
  Authorization::init(1);

if($_SERVER["REQUEST_METHOD"] === "GET") {
 $setId=$_SERVER["HTTP_KEY"]; 
$READ=tatiye::fetch("appoffice","setTabel","id='".$setId."'");
$QUERY=$READ['setTabel']." ORDER BY id DESC";
$COUNT=tatiye::fetch("appoffice"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch(PDO::FETCH_NUM)) {                                   
    $number=$number+1;                                                  
    $sub_array   = array();                                               
    $sub_array[] =$number;                                              
    array_push($products_arr["data"],array_merge($sub_array,$row));  
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
