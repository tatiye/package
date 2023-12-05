<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvaGlzdG9yeS5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);

   $setUId=$_SESSION['user_id'] ;
  if ($setUId==1) {
   $setRow="row='1' ";
  } else {
     $setRow="userid='".$setUId."' ";
  }

if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        *
        FROM apphistory
        WHERE $setRow ORDER BY id DESC";
$COUNT=tatiye::fetch("apphistory"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;                                                  
    $Expuid=tatiye::fetchUserIDTabel($row["userid"]);                                              
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] ='<div class="avatar avatar-sm avatar-offline">
                    <img src="'.$Expuid[2].'" class="rounded-circle" alt="">
                   </div>';                                       
    $sub_array[] ='<dt class="">'.$Expuid[1].'</dt>
                   <dd class="fs-11px">'.$Expuid[3].'</dd>';                                                       
    $sub_array[] =$row["nama"];                                                    
    $sub_array[] =$row["categori"].' '.$row["deskripsi"];                                     
    $sub_array[] =$row["package"];  
    $sub_array[] =$row["date"];                                         
    $sub_array[] =$row["time"];                                                                         
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
