<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJyYmFjXC9BcGlcLzAuMVwvaW5zZXJ1c2VyLnBocCIsInVpZCI6MX0";
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
  #| @Date  Selasa 19 September 2023, 10:17:05 AM                                        
  if($segmen == "insert") {                                                              
  $val=tatiye::validation([                                                              
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                           
     "email"=>tatiye::val("text",$entri->email,"2|Wajib diisi"),                         
     "password"=>tatiye::val("text",$entri->password,"2|Wajib diisi"),                   
     "telepon"=>tatiye::val("text",$entri->telepon,"2|Wajib diisi"),                     
     "alamat"=>tatiye::val("text",$entri->alamat,"2|Wajib diisi"),                       
     "avatar"=>tatiye::val("text",$entri->avatar,"2|Wajib diisi"),                       
     "mapId"=>tatiye::val("text",$entri->mapId,"2|Wajib diisi"),                         
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                               
  ]);                                                                                    
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$entri->nama,                                                         
       "email"    =>$entri->email,                                                       
       "password"    =>$entri->password,                                                 
       "telepon"    =>$entri->telepon,                                                   
       "alamat"    =>$entri->alamat,                                                     
       "avatar"    =>$entri->avatar,                                                     
       "mapId"    =>$entri->mapId,                                                       
       "id"    =>$entri->id,                                                             
       "time"   =>tatiye::tm(),                                                          
       "date"   =>tatiye::dt("EN"),                                                      
       "bulan"  =>tatiye::dt("M"),                                                       
       "tahun"  =>tatiye::dt("Y"),                                                       
       "userid" =>$setUId,                                                               
      );                                                                                 
      $result=$db->que($data)->insert("appuserprofil");                                  
      $val["hasil"]    ="sukses";                                                        
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  #|-----------------------------------------------                                      
  #| Initializes  SEGMENT UPDATE                                                         
  #|-----------------------------------------------                                      
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Selasa 19 September 2023, 10:17:05 AM                                        
  } elseif ($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                           
     "email"=>tatiye::val("text",$entri->email,"2|Wajib diisi"),                         
     "password"=>tatiye::val("text",$entri->password,"2|Wajib diisi"),                   
     "telepon"=>tatiye::val("text",$entri->telepon,"2|Wajib diisi"),                     
     "alamat"=>tatiye::val("text",$entri->alamat,"2|Wajib diisi"),                       
     "avatar"=>tatiye::val("text",$entri->avatar,"2|Wajib diisi"),                       
     "mapId"=>tatiye::val("text",$entri->mapId,"2|Wajib diisi"),                         
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                               
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$entri->nama,                                                         
       "email"    =>$entri->email,                                                       
       "password"    =>$entri->password,                                                 
       "telepon"    =>$entri->telepon,                                                   
       "alamat"    =>$entri->alamat,                                                     
       "avatar"    =>$entri->avatar,                                                     
       "mapId"    =>$entri->mapId,                                                       
       "id"    =>$entri->id,                                                             
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
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
  #| @Date  Selasa 19 September 2023, 10:17:05 AM                                        
    $val=tatiye::validation([                                                            
     "nama"=>tatiye::val("text",$entri->nama,"2|Wajib diisi"),                           
     "email"=>tatiye::val("text",$entri->email,"2|Wajib diisi"),                         
     "password"=>tatiye::val("text",$entri->password,"2|Wajib diisi"),                   
     "telepon"=>tatiye::val("text",$entri->telepon,"2|Wajib diisi"),                     
     "alamat"=>tatiye::val("text",$entri->alamat,"2|Wajib diisi"),                       
     "avatar"=>tatiye::val("text",$entri->avatar,"2|Wajib diisi"),                       
     "mapId"=>tatiye::val("text",$entri->mapId,"2|Wajib diisi"),                         
     "id"=>tatiye::val("text",$entri->id,"2|Wajib diisi"),                               
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$entri->nama,                                                         
       "email"    =>$entri->email,                                                       
       "password"    =>$entri->password,                                                 
       "telepon"    =>$entri->telepon,                                                   
       "alamat"    =>$entri->alamat,                                                     
       "avatar"    =>$entri->avatar,                                                     
       "mapId"    =>$entri->mapId,                                                       
       "id"    =>$entri->id,                                                             
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                        
      tatiye::appfile([                                                                  
         "upload"   =>"images",                                                          
         "tabel"    =>"appuserprofil",                                                   
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
   $IDuser= tatiye::fetch('appuserprofil','*',"id='".$setId."' ORDER BY id DESC");
    $IDappUser=$IDuser['userid'];    
    $result=$db->delete("appusertoken","userid='".$IDappUser."'");
    $result1=$db->delete("appuser","id='".$IDappUser."' ");
    $result2=$db->delete("appuserprofil","id=$setId");
    $response = new Response();
    $response->setHttpStatusCode(200);
    $response->setSuccess(false);
    $response->addMessage("success delete id $setId");
    $response->send();
    exit;
 } else {
    return tatiye::index();
 }
