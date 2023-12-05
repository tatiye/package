<?php                                                                                         
  use app\tatiye;                                                                        
  $Text=tatiye::Text();                                                                  
  $db=new tatiye();                                                                      
  $setId=$_SERVER["HTTP_KEY"];                                                           
  $setUId=$_SERVER["HTTP_USERID"];                                                       
  if (is_numeric($setId)) {                                                              
   $segmen="update";                                                                     
  } else {                                                                               
   $segmen="insert";                                                                     
  }                                                                                      
  #|-------------------------------------                                                
  #| Initializes SEGMENT INSERT                                                          
  #|-------------------------------------                                                
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Sabtu 28 Oktober 2023, 09:28:21 PM                                           
  if ($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                          
   ]);                                                                                   
  if (empty($val["error"])) {    
    tatiye::cookieRead('sso',tatiye::appSSO($_POST["a1"]));

     $data = array(                                                                      
       "appLogin"    =>$_POST["a1"],                                                     
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                        
      tatiye::apphistory([                                                               
        "autoload"     =>false,                                                          
        "categori"     =>"update",                                                       
        "title"        =>$_POST["a1"],                                                   
        "description"  =>"description",                                                  
        "package"      =>"profil",                                                       
        "PrimaryKey"   =>$setId,                                                         
        "tabel"        =>"appuserprofil",                                                
      ]);                                                                                
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  }                                                                                      
   echo json_encode($val);                                                               
