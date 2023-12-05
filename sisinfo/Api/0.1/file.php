<?php
use app\tatiye;
use app\tatiyeNetAuthorization AS Authorization;
use app\Graph\Response;
$NEWTOKEN="eyJkaXIiOiJzaXNpbmZvXC9BcGlcLzAuMVwvZmlsZS5waHAiLCJ1aWQiOjF9";
Authorization::init(1);
if($_SERVER["REQUEST_METHOD"] === "GET") {
  $Root=tatiye::fetch("sisinfo","*","id='".$_SERVER["HTTP_KEY"]."'");
  $RootFile=tatiye::fetch("appfile","filename","keyid='".$_SERVER["HTTP_KEY"]."'");
  $DTX= tatiye::fetch('format','header,kolom',"id='".$Root['archive']."' ");
  $number=0;                                                            
  $products_arr["data"]=array();                                     
  require_once __DIR__.'/'.$Root['archive'].'.php';                                      
  $merge=array(                                                         
    "draw"               =>0,                             
    "recordsTotal"       =>0,                                           
    "recordsFiltered"    =>0,                                           
  );                                                                    
  $json_arr=array_merge($merge,$products_arr);                          
  echo json_encode($json_arr);                                          
} else {
  return tatiye::index();
}
             