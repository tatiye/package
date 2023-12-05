<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJyYmFjXC9BcGlcLzAuMVwvZGF0YXRhYmxlcy5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        *
        FROM appuserprofil
        WHERE row='1' AND userid NOT IN (1)";
  $COUNT=tatiye::fetch("appuserprofil"," COUNT(*) as count");
  $number=0;                                        
  $products_arr["data"]=array();                    
  $variable=tatiye::QY($QUERY);                     
  while ($row = $variable->fetch()) {               
      $number=$number+1;      
      if (!empty($row["avatar"])) {
        $filename=tatiye::LINK('images/'.$row["avatar"]);
      } else {
        $filename=tatiye::LINK('images/profil/admin.jpeg');
      }  

    $IDuser= tatiye::fetch('appuser','*',"id='".$row["userid"]."' ORDER BY id DESC");   

    $sub_array = array();                           
    $sub_array[] =$number;                          
    $sub_array[] =$filename;                   
    $sub_array[] =$row["nama"];                     
    $sub_array[] =$row["email"];                    
    $sub_array[] =$row["password"];                 
    $sub_array[] =$row["telepon"];                  
    $sub_array[] =$row["alamat"];                   
    $sub_array[] =$row["mapId"];                    
    $sub_array[] =$row["id"];                            
    $sub_array[] =$IDuser['loginattempts'];                            
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
