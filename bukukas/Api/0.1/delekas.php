<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJidWt1a2FzXC9BcGlcLzAuMVwvZGVsZWthcy5waHAiLCJ1aWQiOjF9";
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
  #| @Date  Senin 23 Oktober 2023, 04:43:07 PM                                     
  if($segmen == "insert") {                                                        
  $val=tatiye::validation([                                                        
     "saldo"=>tatiye::val("text",$entri->saldo,"2|Wajib diisi"),                   
     "kas"=>tatiye::val("text",$entri->kas,"2|Wajib diisi"),                       
     "aktifitas"=>tatiye::val("text",$entri->aktifitas,"2|Wajib diisi"),           
     "keterangan"=>tatiye::val("text",$entri->keterangan,"2|Wajib diisi"),         
     "sumber"=>tatiye::val("text",$entri->sumber,"2|Wajib diisi"),                 
     "tanggal"=>tatiye::val("text",$entri->tanggal,"2|Wajib diisi"),               
     "total"=>tatiye::val("text",$entri->total,"2|Wajib diisi"),                   
  ]);                                                                              
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "saldo"    =>$entri->saldo,                                                 
       "kas"    =>$entri->kas,                                                     
       "aktifitas"    =>$entri->aktifitas,                                         
       "keterangan"    =>$entri->keterangan,                                       
       "sumber"    =>$entri->sumber,                                               
       "tanggal"    =>$entri->tanggal,                                             
       "total"    =>$entri->total,                                                 
       "time"   =>tatiye::tm(),                                                    
       "date"   =>tatiye::dt("EN"),                                                
       "bulan"  =>tatiye::dt("M"),                                                 
       "tahun"  =>tatiye::dt("Y"),                                                 
       "userid" =>$setUId,                                                         
      );                                                                           
      $result=$db->que($data)->insert("bukukas");                                  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  #|-----------------------------------------------                                
  #| Initializes  SEGMENT UPDATE                                                   
  #|-----------------------------------------------                                
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 23 Oktober 2023, 04:43:07 PM                                     
  } elseif ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "saldo"=>tatiye::val("text",$entri->saldo,"2|Wajib diisi"),                   
     "kas"=>tatiye::val("text",$entri->kas,"2|Wajib diisi"),                       
     "aktifitas"=>tatiye::val("text",$entri->aktifitas,"2|Wajib diisi"),           
     "keterangan"=>tatiye::val("text",$entri->keterangan,"2|Wajib diisi"),         
     "sumber"=>tatiye::val("text",$entri->sumber,"2|Wajib diisi"),                 
     "tanggal"=>tatiye::val("text",$entri->tanggal,"2|Wajib diisi"),               
     "total"=>tatiye::val("text",$entri->total,"2|Wajib diisi"),                   
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "saldo"    =>$entri->saldo,                                                 
       "kas"    =>$entri->kas,                                                     
       "aktifitas"    =>$entri->aktifitas,                                         
       "keterangan"    =>$entri->keterangan,                                       
       "sumber"    =>$entri->sumber,                                               
       "tanggal"    =>$entri->tanggal,                                             
       "total"    =>$entri->total,                                                 
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("bukukas","id =$setId AND userid=$setUId");  
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
  #| @Date  Senin 23 Oktober 2023, 04:43:07 PM                                     
    $val=tatiye::validation([                                                      
     "saldo"=>tatiye::val("text",$entri->saldo,"2|Wajib diisi"),                   
     "kas"=>tatiye::val("text",$entri->kas,"2|Wajib diisi"),                       
     "aktifitas"=>tatiye::val("text",$entri->aktifitas,"2|Wajib diisi"),           
     "keterangan"=>tatiye::val("text",$entri->keterangan,"2|Wajib diisi"),         
     "sumber"=>tatiye::val("text",$entri->sumber,"2|Wajib diisi"),                 
     "tanggal"=>tatiye::val("text",$entri->tanggal,"2|Wajib diisi"),               
     "total"=>tatiye::val("text",$entri->total,"2|Wajib diisi"),                   
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "saldo"    =>$entri->saldo,                                                 
       "kas"    =>$entri->kas,                                                     
       "aktifitas"    =>$entri->aktifitas,                                         
       "keterangan"    =>$entri->keterangan,                                       
       "sumber"    =>$entri->sumber,                                               
       "tanggal"    =>$entri->tanggal,                                             
       "total"    =>$entri->total,                                                 
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("bukukas","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                  
      tatiye::appfile([                                                            
         "upload"   =>"images",                                                    
         "tabel"    =>"bukukas",                                                   
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
    $db->delete("bukukas","id=$setId AND userid=$setUId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete id $setId");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
