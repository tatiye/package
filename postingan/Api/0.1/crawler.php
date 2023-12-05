<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJwb3N0aW5nYW5cL0FwaVwvMC4xXC9jcmF3bGVyLnBocCIsInVpZCI6MX0";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        *
        FROM appnews
        WHERE categori='Crawler'   ORDER BY id DESC  ";
$COUNT=tatiye::fetch("appnews"," COUNT(*) as count","categori='Crawler'");
  $number=0;                                                            
  $products_arr["data"]=array();                                        
  $variable=tatiye::QY($QUERY);
/*
|--------------------------------------------------------------------------
| Initializes item 
|--------------------------------------------------------------------------
| Develover Tatiye.Net 2022
| @Date  
*/

/* and class item */                                             
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;                       
    $sub_array = array();                                               
    $sub_array[] =$number;   
    $sub_array[] ='
                 <img  style="width:200px"
                 src="'.$row["thumbnail"].'" 
                 class="img wd-140 ht-100  rounded-5" 
                 alt="">
      ';                                            
    $sub_array[] ='<div class="media-body pd-l-15">
                      <a href="'.$row["link"].'" class="link-01" target="_blank">
                          <p class="tx-medium mg-b-2">'.$row["title"].'</p>
                      </a>
                      <span class="tx-13 tx-color-03">'.$row["segment"].' | '.$row["date"].' | '.$row["categori"].'| Sort '.$row["ascId"].'</span>
                      <p class="tx-15">'.$row["description"].'</p>
                  </div>
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
