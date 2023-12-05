<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJwb3N0aW5nYW5cL0FwaVwvMC4xXC9wb3N0aW5nYW4ucGhwIiwidWlkIjoxfQ";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        *
        FROM appnews
        WHERE segment='Tatiye'   ORDER BY ascId  ";
$COUNT=tatiye::fetch("appnews"," COUNT(*) as count","segment='Tatiye'");
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
function ImgsF($key){
    $str='';
    $resultItems =tatiye::sqli("SELECT filename,date FROM appfile WHERE keyid='".$key."' AND nmtabel='appnews' AND categori='images' ORDER BY ascId ");
     while ($item = $resultItems->fetch_array()) {  
      $str=$str.'
                 <img  
                 src="'.tatiye::resizeTabelImage('300x215',$item['filename']).'" 
                 class="img wd-40 wd-sm-60 ht-40 ht-sm-60 rounded-circle" 
                 alt="">
      ';
    } 
     return '<div class="img-group">'.$str.'</div>';  
}
/* and class item */                                             
  while ($row = $variable->fetch()) {                                   
    $number=$number+1;     
      if (!empty($row["thumbnail"])) {
        $filename=$row["thumbnail"];
      } else {
        if (!empty(ImgsF($row["id"]))) {
          $filename=ImgsF($row["id"]);
        } else {
          $filename=tatiye::LINK('images/anomous.png');
        } 
      }   
                                
    $sub_array = array();                                               
    $sub_array[] =$number;   
     $sub_array[] =$filename;                                            
    $sub_array[] ='<div class="media-body pd-l-15">
                      <a href="'.tatiye::LINK('posts/'.$row["link"]).'" class="link-01" target="_blank">
                          <p class="tx-medium mg-b-2">'.$row["title"].'</p>
                      </a>
                      <span class="tx-13 tx-color-03">'.$row["segment"].' | '.$row["date"].' | '.$row["categori"].' | Sort '.$row["ascId"].'</span>
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
