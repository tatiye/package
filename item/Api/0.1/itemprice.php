<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJpdGVtXC9BcGlcLzAuMVwvaXRlbXByaWNlLnBocCIsInVpZCI6MX0";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        * 
        FROM salesitem
        WHERE idprice='".$_SERVER["HTTP_KEY"]."'";
$COUNT=tatiye::fetch("salesitem"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;     
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] =$row["title"];                                        
    $sub_array[] =$row["nama"];                                         
    $sub_array[] =$row["id"];                                           
    $Expuid=tatiye::fetchUserIDTabel($row["userid"]);                    
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
