<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJyZWFjdFwvQXBpXC8wLjFcL2Zyb20ucGhwIiwidWlkIjoxfQ";
$entri=json_decode(file_get_contents("php://input"));
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
  #| @Date  Selasa 05 September 2023, 01:28:48 PM                               
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                  
     "title"=>tatiye::val("text",$entri->title,"2|Wajib diisi"),                
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$entri->nama,                                                
       "title"   =>$entri->title,                                              
       "time"    =>tatiye::tm(),                                                 
       "date"    =>tatiye::dt("EN"),                                             
       "bulan"   =>tatiye::dt("M"),                                              
       "tahun"   =>tatiye::dt("Y"),                                              
       "userid"  =>$setUId,                                                      
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
  #| @Date  Selasa 05 September 2023, 01:28:48 PM                               
  } elseif ($segmen == "update") {                                              
    $val=tatiye::validation([                                                   
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                  
     "title"=>tatiye::val("text",$entri->title,"2|Wajib diisi"),                
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"     =>$entri->nama,                                                
       "title"    =>$entri->title,                                              
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
    echo json_encode($val); 
    exit;
 } elseif ($_SERVER["REQUEST_METHOD"] === "PATCH"){
  #|-----------------------------------------------                             
  #| Initializes  SEGMENT UPLOAD FILE                                           
  #|-----------------------------------------------                             
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Selasa 05 September 2023, 01:28:48 PM                               
    $val=tatiye::validation([                                                   
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                  
     "title"=>tatiye::val("text",$entri->title,"2|Wajib diisi"),                
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"     =>$entri->nama,                                                
       "title"    =>$entri->title,                                              
       "time"     =>tatiye::tm(),                                               
       "date"     =>tatiye::dt("EN"),                                           
       "bulan"    =>tatiye::dt("M"),                                            
       "tahun"    =>tatiye::dt("Y"),                                            
      );                                                                        
      $result=$db->que($data)->update("demo","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                               
      tatiye::appfile([                                                         
         "upload"   =>"images",                                                 
         "tabel"    =>"demo",                                                   
         "setId"    =>$setId,                                                   
         "setUId"   =>$setUId,                                                  
         "file"     =>$entri->file,                                             
         "base64"   =>$entri->base64,                                           
       ]);                                                                      
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
    echo json_encode($val); 
 } elseif ($_SERVER["REQUEST_METHOD"] === "DELETE"){
    $db->delete("demo","id=$setId AND userid=$setUId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete ");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
