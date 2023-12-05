<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJwb3J0Zm9saW9cL0FwaVwvMC4xXC9wb3J0Zm9saW8ucGhwIiwidWlkIjoxfQ";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,title,deskripsi,id,userid 
        FROM portfolio
        WHERE row='1' ORDER BY id DESC";
$COUNT=tatiye::fetch("portfolio"," COUNT(*) as count");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);                                         
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;          
    $IMGS= tatiye::fetch('appfile','filename,date',"keyid='".$row['id']."' AND nmtabel='portfolio' AND categori='images' ORDER BY id DESC");

        $filename=tatiye::resizeTabelImage('80x80',$IMGS['filename']);
                                          
    $sub_array = array();                                               
    $sub_array[] =$number;                                              
    $sub_array[] ='<div class="wd-100 ">
                    <img src="'.$filename.'" class=" rounded img-thumbnail" alt="">
                   </div>';                                             
    $sub_array[] =$row["nama"];                                         
    $sub_array[] ='<dd>'.$row["title"].'</dd>
                    <dd>Detail: '.$row["deskripsi"].'</dd>
                  ';                                                       
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
