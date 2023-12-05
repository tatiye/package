<?php
error_reporting(0);
use app\tatiye;
use app\Graph\Response AS Response;
use app\tatiyeNetAuthorization AS Authorization;
$NEWTOKEN="eyJkaXIiOiJwcm9maWxcL0FwaVwvMC4xXC9wcm9maWwucGhwIiwidWlkIjoxfQ";
$entri=json_decode(file_get_contents("php://input"));
Authorization::init(1);
Authorization::HTTP_KEY($_SERVER["HTTP_KEY"]);
Authorization::HTTP_USERID($_SERVER["HTTP_USERID"]);
$db=new tatiye();
$Text=tatiye::Text();
$setId=$_SERVER["HTTP_KEY"];
$setUId=$_SERVER["HTTP_USERID"];
if($_SERVER["REQUEST_METHOD"] === "POST") {                                                         
                                                                    
  #|-----------------------------------------------                                      
  #| Initializes  SEGMENT UPDATE                                                         
  #|-----------------------------------------------                                      
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Sabtu 02 September 2023, 03:27:51 PM                                         
  if ($setId) {                                                       
        $val=tatiye::validation([                                                      
         "nama"    =>tatiye::val('nameText1',$entri->fullname??=false,20),                                             
         "email"   =>tatiye::val('emailAccount',$entri->email,$setId,25),                                          
         "password"=>tatiye::val("PasswordStr",$entri->password,"2|Wajib diisi"),                             
         "telepon" =>tatiye::val("Handphone",$entri->telepon,"2|Wajib diisi"),                             
         "alamat"  =>tatiye::val("text",$entri->alamat,"2|Wajib diisi"),                             
        ]);                                                                                   
       if (empty($val["error"])) {                                                            
          $data = array(                                                                      
            "nama"        =>$entri->fullname,                                                          
            "email"       =>$entri->email,                                                         
            "password"    =>$entri->password,                                                      
            "telepon"     =>$entri->telepon,                                                       
            "alamat"      =>$entri->alamat,                                                                        
            "time"        =>tatiye::tm(),                                                        
            "date"        =>tatiye::dt("EN"),                                                    
            "bulan"       =>tatiye::dt("M"),                                                     
            "tahun"       =>tatiye::dt("Y"),                                                     
           );                                                                                 
           $result=$db->que($data)->update("appuserprofil","id =$setId ");  
       // UPDATE APPUSER ID
       $hashed_password = password_hash($data["password"], PASSWORD_DEFAULT);                           
       $memberUid = array(                                                                      
       "fullname" =>$data["nama"],                                                 
       "username" =>$data["email"],                                                 
       "password" =>$hashed_password
       );                                                                                 
      $result=$db->que($memberUid)->update("appuser","id =$setUId");  
           $val["data"]    =tatiye::useProfil($setUId);                                                        
           $val["hasil"]    ="sukses";                                                        
       } else {                                                                               
           $val["hasil"]    ="error";                                                         
       };                                                                                    
  }                                                                                      
     echo json_encode($val);     
 } else {
    return tatiye::index();
 }
