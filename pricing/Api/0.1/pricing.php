<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$db=new tatiye();
$Exp=array();
$Text=tatiye::Text();
$item_arr=array();
$NEWTOKEN="eyJkaXIiOiJwcmljaW5nXC9BcGlcLzAuMVwvcHJpY2luZy5waHAiLCJ1aWQiOjF9";
  Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
$QUERY="SELECT 
        nama,title,deskripsi,harga,id 
        FROM sales
        WHERE row='1'";
$COUNT=tatiye::fetch("sales"," COUNT(*) as count");
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
function item($key){
    $str='';
    $resultItems =tatiye::sqli("SELECT nama FROM salesitem WHERE idprice='".$key."'");
     while ($item = $resultItems->fetch_array()) {  
      $str=$str.'<li>'.$item['nama'].'</li>';
    } 
     return '<ol>'.$str.'</ol>';  
}
/* and class item */




  while ($row = $variable->fetch()) {                                   
    $number=$number+1;   
    $IMGS= tatiye::fetch('appfile','filename,date',"keyid='".$row['id']."' AND nmtabel='sales' AND categori='images' ORDER BY id DESC");

     if (!empty($IMGS['filename'])) {
        $filename=tatiye::LINK($IMGS['filename']);
      } else {
        $filename=tatiye::LINK('images/anomous.png');
      }  

    $sub_array = array();                                               
    $sub_array[] =$number;     
    $sub_array[] ='<div class="wd-100 ">
                    <img src="'.$filename.'" class=" rounded img-thumbnail" alt="">
                   </div>';                                             
    $sub_array[] =$row["title"];                                         
    $sub_array[] ='<dd><b>'.$row["nama"].'</b></dd>
                    <dd>Detail: '.$row["deskripsi"].'</dd>
                  ';                                                                       
    $sub_array[] =item($row["id"]);            
    $sub_array[] =$Text->numberFormat([$row["harga"],0]);            
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
