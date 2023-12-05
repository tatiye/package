<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvc3BhbS5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);

  $setUId=$_SESSION['user_id'] ;
  if ($setUId==1) {
   $setRow="row='1' ";
  } else {
     $setRow="userid='".$setUId."' ";
  }


if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,categori,deskripsi,keyid,nmtabel,userid,id,date,time,arsip
        FROM apparchive
        WHERE $setRow AND categori='spam' ORDER BY id DESC";
$COUNT=tatiye::fetch("apparchive"," COUNT(*) as count");
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
    $sub_array[] =$row["deskripsi"];                                     
    $sub_array[] =$row["nmtabel"];  
    $sub_array[] =$row["date"];                                         
    $sub_array[] =$row["time"];                                      
    // $sub_array[] =$row["arsip"];                                      
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
