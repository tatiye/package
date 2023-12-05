<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJyYmFjXC9BcGlcLzAuMVwvaW5zZXJ0cmJhYy5waHAiLCJ1aWQiOjF9";
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
  #| @Date  Selasa 19 September 2023, 11:22:12 AM                                         
  if($segmen == "insert") {                                                               
  $val=tatiye::validation([                                                               
     "packageid"=>tatiye::val("text",$entri->packageid,"2|Wajib diisi"),                  
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                            
     "namaBase"=>tatiye::val("text",$entri->namaBase,"2|Wajib diisi"),                    
     "icon"=>tatiye::val("text",$entri->icon,"2|Wajib diisi"),                            
     "deskripsi"=>tatiye::val("text",$entri->deskripsi,"2|Wajib diisi"),                  
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                                
  ]);                                                                                     
  if (empty($val["error"])) {                                                             
     $data = array(                                                                       
       "packageid"    =>$entri->packageid,                                                
       "nama"    =>$entri->nama,                                                          
       "namaBase"    =>$entri->namaBase,                                                  
       "icon"    =>$entri->icon,                                                          
       "deskripsi"    =>$entri->deskripsi,                                                
       "id"    =>$entri->id,                                                              
       // "time"   =>tatiye::tm(),                                                           
       // "date"   =>tatiye::dt("EN"),                                                       
       // "bulan"  =>tatiye::dt("M"),                                                        
       // "tahun"  =>tatiye::dt("Y"),                                                        
       "userid" =>$setUId,                                                                
      );                                                                                  
      $result=$db->que($data)->insert("appuserpackage");                                  
      $val["hasil"]    ="sukses";                                                         
  } else {                                                                                
      $val["hasil"]    ="error";                                                          
   };                                                                                     
  #|-----------------------------------------------                                       
  #| Initializes  SEGMENT UPDATE                                                          
  #|-----------------------------------------------                                       
  #| Develover Tatiye.Net 2023                                                            
  #| @Date  Selasa 19 September 2023, 11:22:12 AM                                         
  } elseif ($segmen == "update") {                                                        
    $val=tatiye::validation([                                                             
     "packageid"=>tatiye::val("text",$entri->packageid,"2|Wajib diisi"),                  
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                            
     "namaBase"=>tatiye::val("text",$entri->namaBase,"2|Wajib diisi"),                    
     "icon"=>tatiye::val("text",$entri->icon,"2|Wajib diisi"),                            
     "deskripsi"=>tatiye::val("text",$entri->deskripsi,"2|Wajib diisi"),                  
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                                
   ]);                                                                                    
  if (empty($val["error"])) {                                                             
     $data = array(                                                                       
       "packageid"    =>$entri->packageid,                                                
       "nama"    =>$entri->nama,                                                          
       "namaBase"    =>$entri->namaBase,                                                  
       "icon"    =>$entri->icon,                                                          
       "deskripsi"    =>$entri->deskripsi,                                                
       "id"    =>$entri->id,                                                              
       "time"     =>tatiye::tm(),                                                         
       "date"     =>tatiye::dt("EN"),                                                     
       "bulan"    =>tatiye::dt("M"),                                                      
       "tahun"    =>tatiye::dt("Y"),                                                      
      );                                                                                  
      $result=$db->que($data)->update("appuserpackage","id =$setId AND userid=$setUId");  
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
  #| @Date  Selasa 19 September 2023, 11:22:12 AM                                         
    $val=tatiye::validation([                                                             
     "packageid"=>tatiye::val("text",$entri->packageid,"2|Wajib diisi"),                  
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                            
     "namaBase"=>tatiye::val("text",$entri->namaBase,"2|Wajib diisi"),                    
     "icon"=>tatiye::val("text",$entri->icon,"2|Wajib diisi"),                            
     "deskripsi"=>tatiye::val("text",$entri->deskripsi,"2|Wajib diisi"),                  
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                                
   ]);                                                                                    
  if (empty($val["error"])) {                                                             
     $data = array(                                                                       
       "packageid"    =>$entri->packageid,                                                
       "nama"    =>$entri->nama,                                                          
       "namaBase"    =>$entri->namaBase,                                                  
       "icon"    =>$entri->icon,                                                          
       "deskripsi"    =>$entri->deskripsi,                                                
       "id"    =>$entri->id,                                                              
       "time"     =>tatiye::tm(),                                                         
       "date"     =>tatiye::dt("EN"),                                                     
       "bulan"    =>tatiye::dt("M"),                                                      
       "tahun"    =>tatiye::dt("Y"),                                                      
      );                                                                                  
      $result=$db->que($data)->update("appuserpackage","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                         
      tatiye::appfile([                                                                   
         "upload"   =>"images",                                                           
         "tabel"    =>"appuserpackage",                                                   
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
    $db->delete("appuserpackage","id=$setId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete id $setId");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
