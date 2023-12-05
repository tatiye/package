<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJkZW1vXC9BcGlcLzAuMVwvdGVzZGVtby5waHAiLCJ1aWQiOjF9";
Authorization::init(1);
Authorization::HTTP_KEY($_SERVER["HTTP_KEY"]);
Authorization::HTTP_USERID($_SERVER["HTTP_USERID"]);
$db=new tatiye();
$Text=tatiye::Text();
$setId=$_SERVER["HTTP_KEY"];
$setUId=$_SERVER["HTTP_USERID"];
if($_SERVER["REQUEST_METHOD"] === "POST") {
  if (is_numeric($setId)) {                                                     
   $segmen="update";                                                            
  } else {                                                                      
   $segmen="insert";                                                            
  }                                                                             
  #|-------------------------------------                                       
  #| Initializes SEGMENT INSERT                                                 
  #|-------------------------------------                                       
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Rabu 30 Agustus 2023, 10:08:52 AM                                   
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "az1"=>tatiye::val("text",$_POST["az1"]   ,"2|Wajib diisi"),               
     "az2"=>tatiye::val("text",$_POST["az2"]   ,"2|Wajib diisi"),               
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["az1"],                                               
       "title"    =>$_POST["az2"],                                              
       "time"   =>tatiye::tm(),                                                 
       "date"   =>tatiye::dt("EN"),                                             
       "bulan"  =>tatiye::dt("M"),                                              
       "tahun"  =>tatiye::dt("Y"),                                              
       "userid" =>$setUId,                                                      
      );                                                                        
      $result=$db->que($data)->insert("demo");                                  
      $val["hasil"]    ="sukses";                                               
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  #|-----------------------------------------------                             
  #| Initializes  SEGMENT UPDATE                                                
  #|-----------------------------------------------                             
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Rabu 30 Agustus 2023, 10:08:52 AM                                   
  } elseif ($segmen == "update") {                                              
    $val=tatiye::validation([                                                   
     "az1"=>tatiye::val("text",$_POST["az1"]   ,"2|Wajib diisi"),               
     "az2"=>tatiye::val("text",$_POST["az2"]   ,"2|Wajib diisi"),               
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["az1"],                                               
       "title"    =>$_POST["az2"],                                              
       "time"     =>tatiye::tm(),                                               
       "date"     =>tatiye::dt("EN"),                                           
       "bulan"    =>tatiye::dt("M"),                                            
       "tahun"    =>tatiye::dt("Y"),                                            
      );                                                                        
      $result=$db->que($data)->update("demo","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                               
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  }                                                                             
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(true);
    $response->addMessage("Satatus $segmen data");
    $response->addMessage($val);
    $response->send();
    exit;
 } elseif ($_SERVER["REQUEST_METHOD"] === "DELETE"){
    $db->delete("demo","id=$setId AND userid=$setUId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete id $setId");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
