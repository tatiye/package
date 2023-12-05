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
  #| @Date  Kamis 02 November 2023, 06:10:28 PM                                          
  if($segmen == "insert") {                                                              
  $val=tatiye::validation([                                                              
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                          
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                          
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                          
  ]);                                                                                    
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$_POST["a1"],                                                         
       "email"    =>$_POST["a2"],                                                        
       "password"    =>$_POST["a3"],                                                     
       "time"   =>tatiye::tm(),                                                          
       "date"   =>tatiye::dt("EN"),                                                      
       "bulan"  =>tatiye::dt("M"),                                                       
       "tahun"  =>tatiye::dt("Y"),                                                       
       "userid" =>$setUId,                                                               
      );                                                                                 
      $result=$db->que($data)->insert("appuserprofil");                                  
      $val["hasil"]    ="sukses";                                                        
      tatiye::apphistory([                                                               
        "autoload"     =>false,                                                          
        "categori"     =>"insert",                                                       
         "title"        =>$_POST["a1"],                                                  
        "description"  =>"description",                                                  
        "PrimaryKey"   =>0,                                                              
        "package"      =>"profil",                                                       
        "tabel"        =>"appuserprofil",                                                
      ]);                                                                                
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  #|-----------------------------------------------                                      
  #| Initializes  SEGMENT UPDATE                                                         
  #|-----------------------------------------------                                      
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Kamis 02 November 2023, 06:10:28 PM                                          
  } elseif ($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                          
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                          
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                          
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "nama"    =>$_POST["a1"],                                                         
       "email"    =>$_POST["a2"],                                                        
       "password"    =>$_POST["a3"],                                                     
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
