<?php                                                                                
  use app\tatiye;                                                               
  $Text=tatiye::Text();                                                         
  $db=new tatiye();       
 //$_SERVER['HTTP_AUTHORIZATION']                                  
  $setId=$_SERVER['HTTP_KEY'];                                                         
  $setUId=$_SERVER["HTTP_USERID"];                                                      
  if (is_numeric($setId)) {                                              
   $segmen="update";                                                            
  } else {                                                                      
   $segmen="insert";                                                            
  }                                                                                     
                                                                                    
  #|-----------------------------------------------                                      
  #| Initializes  SEGMENT UPDATE                                                         
  #|-----------------------------------------------                                      
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Senin 21 Agustus 2023, 10:12:01 PM                                           
  if ($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "akun1"=>tatiye::val("text",$_POST["akun1"]   ,"2|Wajib diisi"),                    
     "akun2"=>tatiye::val("emailAccount",$_POST["akun2"]   ,$setId,25),                    
     "akun3"=>tatiye::val("PasswordStr",$_POST["akun3"]   ,"2|Wajib diisi"),                    
     "akun4"=>tatiye::val("text",$_POST["akun4"]   ,"2|Wajib diisi"),                    
     "akun5"=>tatiye::val("text",$_POST["akun5"]   ,"2|Wajib diisi"),                    
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$_POST["akun1"],                                                      
       "email"    =>$_POST["akun2"],                                                     
       "password"    =>$_POST["akun3"],                                                  
       "telepon"    =>$_POST["akun4"],                                                   
       "alamat"    =>$_POST["akun5"],                                                    
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
       $hashed_password = password_hash($_POST["akun3"], PASSWORD_DEFAULT);                           
       $memberUid = array(                                                                      
       "fullname" =>$_POST["akun1"],                                                 
       "username" =>$_POST["akun2"],                                                 
       "password" =>$hashed_password
       );                                                                                 
      $result=$db->que($memberUid)->update("appuser","id =$setUId");  

      $val["hasil"]    ="sukses";  



  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  }                                                                                      
   echo json_encode($val);                                                               
