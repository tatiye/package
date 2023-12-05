<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJwcm9maWxcL0FwaVwvMC4xXC9hcHB1c2VyLnBocCIsInVpZCI6MX0";
$entri=json_decode(file_get_contents("php://input"));
// Authorization::init(1);
Authorization::HTTP_KEY($_SERVER["HTTP_KEY"]);
Authorization::HTTP_USERID($_SERVER["HTTP_USERID"]);
$db=new tatiye();
$Text=tatiye::Text();
$setId=$_SERVER["HTTP_KEY"];
$setUId=$_SERVER["HTTP_USERID"];
                                                                                     
  #|-------------------------------------                                                
  #| Initializes SEGMENT INSERT                                                          
  #|-------------------------------------                                                
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Selasa 12 September 2023, 12:49:38 PM                                        
  if ($_SERVER["REQUEST_METHOD"] === "POST"){
  #|-----------------------------------------------                                      
  #| Initializes  SEGMENT UPLOAD FILE                                                    
  #|-----------------------------------------------                                      
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Selasa 12 September 2023, 12:49:38 PM                                        
    $val=tatiye::validation([                                                            
     "file"=>tatiye::val("text",$entri->file,"2|Wajib diisi"),                                                   
   ]);                                                                                                                                             
   if (empty($val["error"])) {                                                            
      $val["hasil"]    ="sukses";                                                        
      tatiye::appfile([                                                                  
         "upload"   =>"profil",                                                          
         "tabel"    =>"appuserprofil",                                                   
         "setId"    =>$setId,                                                            
         "setUId"   =>$setUId,                                                           
         "file"     =>$entri->file,                                                      
         "base64"   =>$entri->base64,                                                    
       ]);
       $val["data"]    =tatiye::useProfil($setUId);                                                                                
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
    echo json_encode($val); 
 } else {
    return tatiye::index();
 }
