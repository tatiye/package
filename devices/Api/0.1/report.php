<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvcmVwb3J0LnBocCIsInVpZCI6MX0";
  Authorization::init(1);

   $setUId=$_SESSION['user_id'] ;
  // if ($setUId==1) {
   $setRow="row='1' ";
  // } else {
     // $setRow="id='".$setUId."' ";
  // }

if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,email,password,telepon,alamat,avatar,mapId,status,route,id,userid
        FROM appuserprofil
        WHERE $setRow ";
$COUNT=tatiye::fetch("appuserprofil"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;                                                  
    $Expuid=tatiye::fetchUserIDTabel($row["id"]);   
    $Count=tatiye::useHandelCount('apphistory'," userid='".$row['userid']."' ");                   
    $CountAll=tatiye::useHandelCount('apphistory'," row='1' ");                   
    $CatUpdate=tatiye::useHandelCount('apphistory',"categori='update' AND userid='".$row['userid']."' ");                    
    $CatInsert=tatiye::useHandelCount('apphistory',"categori='insert' AND userid='".$row['userid']."' ");    
    $Progress=round($Count["count"]/$CountAll["count"]*100,0);
    $rangeColor=tatiye::rangeColor("bgColor",$Count["count"],$number);
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] ='<div class="avatar avatar-sm avatar-offline">
                    <img src="'.$Expuid[2].'" class="rounded-circle" alt="">
                   </div>';                                       
    $sub_array[] ='<dt class="">'.$row["nama"].'</dt>
                   <dd class="fs-11px">'.$row["email"].'</dd>
                   <div class="progress ht-4 mg-b-0 op-5">
                          <div class="progress-bar '.$rangeColor.' wd-'.$Progress.'p" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                   ';                                                                                   
    $sub_array[] =$CatUpdate['count'];                                     
    $sub_array[] =$CatInsert['count'];                                      
    $sub_array[] =$Count["count"];                                                                            
    $sub_array[] =$Progress.' %';                                        
    $sub_array[] =tatiye::dt('EN');                                    
    $sub_array[] =tatiye::tm('zona');                                        
    $sub_array[] =$row["id"];                                        
    array_push($products_arr["data"], ($sub_array));  
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
