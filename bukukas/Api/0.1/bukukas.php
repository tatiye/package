<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJidWt1a2FzXC9BcGlcLzAuMVwvYnVrdWthcy5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        saldo,kas,aktifitas,keterangan,sumber,tanggal,bulan,tahun,total,id,userid 
        FROM bukukas
        WHERE row='1' ORDER BY tanggal ASC";
$COUNT=tatiye::fetch("bukukas"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;                                                  
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] =$row["tanggal"];                                      
    $sub_array[] =$row["keterangan"];                                   
    $sub_array[] =$row["sumber"];                                       
    $sub_array[] =$row["aktifitas"];                                    
    $sub_array[] =$row["bulan"].'/'.$row["tahun"];                                    
    $sub_array[] =$row["saldo"];                                        
    $sub_array[] =$row["kas"];                                          
    $sub_array[] =$row["total"];                                        
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
