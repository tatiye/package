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
  #| @Date  Senin 06 November 2023, 05:28:35 PM                                   
  if($segmen == "insert") {                                                       
  $val=tatiye::validation([                                                       
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"1|Wajib diisi"),                 
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"1|Wajib diisi"),                 
     "ab3"=>tatiye::val("text",$_POST["ab3"]   ,"1|Wajib diisi"),                 
     "ab4"=>tatiye::val("text",$_POST["ab4"]   ,"1|Wajib diisi"),                 
  ]);                                                                             
  if (empty($val["error"])) {                                                     
     $data = array(                                                               
       "status"    =>$_POST["ab1"],                                               
       "nama"    =>$_POST["ab2"],                                                 
       "harga"    =>$_POST["ab3"],                                                
       "deskripsi"    =>$_POST["ab4"],                                            
       "time"   =>tatiye::tm(),                                                   
       "date"   =>tatiye::dt("EN"),                                               
       "bulan"  =>tatiye::dt("M"),                                                
       "tahun"  =>tatiye::dt("Y"),                                                
       "userid" =>$setUId,                                                        
      );                                                                          
      $result=$db->que($data)->insert("biling");                                  
      $val["hasil"]    ="sukses";                                                 
      tatiye::apphistory([                                                        
        "autoload"     =>false,                                                   
        "categori"     =>"insert",                                                
         "title"        =>$_POST["ab1"],                                          
        "description"  =>"description",                                           
        "PrimaryKey"   =>0,                                                       
        "package"      =>"biling",                                                
        "tabel"        =>"biling",                                                
      ]);                                                                         
  } else {                                                                        
      $val["hasil"]    ="error";                                                  
   };                                                                             
  #|-----------------------------------------------                               
  #| Initializes  SEGMENT UPDATE                                                  
  #|-----------------------------------------------                               
  #| Develover Tatiye.Net 2023                                                    
  #| @Date  Senin 06 November 2023, 05:28:35 PM                                   
  } elseif ($segmen == "update") {                                                
    $val=tatiye::validation([                                                     
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"1|Wajib diisi"),                 
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"1|Wajib diisi"),                 
     "ab3"=>tatiye::val("text",$_POST["ab3"]   ,"1|Wajib diisi"),                 
     "ab4"=>tatiye::val("text",$_POST["ab4"]   ,"1|Wajib diisi"),                 
   ]);                                                                            
  if (empty($val["error"])) {                                                     
     $data = array(                                                               
       "status"    =>$_POST["ab1"],                                               
       "nama"    =>$_POST["ab2"],                                                 
       "harga"    =>$_POST["ab3"],                                                
       "deskripsi"    =>$_POST["ab4"],                                            
       "time"     =>tatiye::tm(),                                                 
       "date"     =>tatiye::dt("EN"),                                             
       "bulan"    =>tatiye::dt("M"),                                              
       "tahun"    =>tatiye::dt("Y"),                                              
      );                                                                          
      $result=$db->que($data)->update("biling","id =$setId ");  
      $val["hasil"]    ="sukses";                                                 
      tatiye::apphistory([                                                        
        "autoload"     =>false,                                                   
        "categori"     =>"update",                                                
        "title"        =>$_POST["ab1"],                                           
        "description"  =>"description",                                           
        "package"      =>"biling",                                                
        "PrimaryKey"   =>$setId,                                                  
        "tabel"        =>"biling",                                                
      ]);                                                                         
  } else {                                                                        
      $val["hasil"]    ="error";                                                  
   };                                                                             
  }                                                                               
   echo json_encode($val);                                                        
