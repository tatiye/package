<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJkZXZpY2VzXC9BcGlcLzAuMVwvaW5zZXJ0LnBocCIsInVpZCI6MX0";
$entri=json_decode(file_get_contents("php://input"));
Authorization::init(1);
Authorization::HTTP_KEY($_SERVER["HTTP_KEY"]);
Authorization::HTTP_USERID($_SERVER["HTTP_USERID"]);
$db=new tatiye();
$Text=tatiye::Text();
$setId=$_SERVER["HTTP_KEY"];
$setUId=$_SESSION['user_id'] ;
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
  #| @Date  Selasa 26 September 2023, 12:49:08 PM                                  
  if($segmen == "insert") {                                                        
  $val=tatiye::validation([                                                        
     "keyid"=>tatiye::val("text",$entri->keyid,"2|Wajib diisi"),                   
     "categori"=>tatiye::val("text",$entri->categori,"2|Wajib diisi"),             
     "nmtabel"=>tatiye::val("text",$entri->nmtabel,"2|Wajib diisi"),               
     "fileType"=>tatiye::val("text",$entri->fileType,"2|Wajib diisi"),             
     "filename"=>tatiye::val("text",$entri->filename,"2|Wajib diisi"),             
  ]);                                                                              
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "keyid"    =>$entri->keyid,                                                 
       "categori"    =>$entri->categori,                                           
       "nmtabel"    =>$entri->nmtabel,                                             
       "fileType"    =>$entri->fileType,                                           
       "filename"    =>$entri->filename,                                           
       "time"   =>tatiye::tm(),                                                    
       "date"   =>tatiye::dt("EN"),                                                
       "bulan"  =>tatiye::dt("M"),                                                 
       "tahun"  =>tatiye::dt("Y"),                                                 
       "userid" =>$setUId,                                                         
      );                                                                           
      $result=$db->que($data)->insert("appfile");                                  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  #|-----------------------------------------------                                
  #| Initializes  SEGMENT UPDATE                                                   
  #|-----------------------------------------------                                
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Selasa 26 September 2023, 12:49:08 PM                                  
  } elseif ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "keyid"=>tatiye::val("text",$entri->keyid,"2|Wajib diisi"),                   
     "categori"=>tatiye::val("text",$entri->categori,"2|Wajib diisi"),             
     "nmtabel"=>tatiye::val("text",$entri->nmtabel,"2|Wajib diisi"),               
     "fileType"=>tatiye::val("text",$entri->fileType,"2|Wajib diisi"),             
     "filename"=>tatiye::val("text",$entri->filename,"2|Wajib diisi"),             
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "keyid"    =>$entri->keyid,                                                 
       "categori"    =>$entri->categori,                                           
       "nmtabel"    =>$entri->nmtabel,                                             
       "fileType"    =>$entri->fileType,                                           
       "filename"    =>$entri->filename,                                           
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("appfile","id =$setId AND userid=$setUId");  
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
  #| @Date  Selasa 26 September 2023, 12:49:08 PM                                  
    $val=tatiye::validation([                                                      
     "keyid"=>tatiye::val("text",$entri->keyid,"2|Wajib diisi"),                   
     "categori"=>tatiye::val("text",$entri->categori,"2|Wajib diisi"),             
     "nmtabel"=>tatiye::val("text",$entri->nmtabel,"2|Wajib diisi"),               
     "fileType"=>tatiye::val("text",$entri->fileType,"2|Wajib diisi"),             
     "filename"=>tatiye::val("text",$entri->filename,"2|Wajib diisi"),             
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "keyid"    =>$entri->keyid,                                                 
       "categori"    =>$entri->categori,                                           
       "nmtabel"    =>$entri->nmtabel,                                             
       "fileType"    =>$entri->fileType,                                           
       "filename"    =>$entri->filename,                                           
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("appfile","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                  
      tatiye::appfile([                                                            
         "upload"   =>"images",                                                    
         "tabel"    =>"appfile",                                                   
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
    $db->delete("appsampah","id=$setId AND userid=$setUId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete id $setId");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
