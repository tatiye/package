<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvYm9va21hcmsucGhwIiwidWlkIjoxfQ";
  Authorization::init(1);

   $setUId=$_SESSION['user_id'] ;
  if ($setUId==1) {
   $setRow="row='1' ";
  } else {
     $setRow="userid='".$setUId."' ";
  }

if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,categori,deskripsi,keyid,nmtabel,userid,id,date,time,arsip,bookmark
        FROM apparchive
        WHERE $setRow AND categori='bookmark' ORDER BY id DESC";
$COUNT=tatiye::fetch("apparchive"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {  

     if($row["bookmark"] == 'youtube') {
         $icon='<span class="avatar-initial rounded-circle bg-gray-400"><i class="icon-feather-play"></i></span>';
      } elseif ($row["bookmark"] == 'github'){
         $icon='<span class="avatar-initial rounded-circle bg-gray-400"><i class="icon-feather-github"></i></span>';

      } elseif ($row["bookmark"] == 'facebook'){
         $icon='<span class="avatar-initial rounded-circle bg-gray-400"><i class="icon-feather-facebook"></i></span>';
     
      } else {
         $icon='<span class="avatar-initial rounded-circle bg-gray-400"><i class="icon-feather-globe"></i></span>';
     
      }                                 
    $number=$number+1;                                                  
    $Expuid=tatiye::fetchUserIDTabel($row["userid"]);                                              
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] ='<div style="width: 28px; height: 28px;" class="avatar d-none d-sm-block">
                   '.$icon.'
                  </div>';                                       
    $sub_array[] ='<dt> <a class="tx-gray-900"href="'.$row["deskripsi"].'" target="_blank">'.$row["nama"].'</a></dt>
                   <dd class="fs-11px">'.$row["bookmark"].'</dd>';                                         
    // $sub_array[] =$row["nama"];                                         
    // $sub_array[] =$row["deskripsi"];                                     
    // $sub_array[] =$row["bookmark"];  
    $sub_array[] =$row["date"];                                         
    $sub_array[] =$row["time"];                                                                          
    $sub_array[] =$row["id"];                                           
    array_push($products_arr["data"],$sub_array);  
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
