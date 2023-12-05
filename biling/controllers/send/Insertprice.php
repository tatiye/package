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
  #| @Date  Jumat 03 November 2023, 12:25:17 PM                                  
  if($segmen == "insert") {                                                      
  $val=tatiye::validation([                                                      
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"2|Wajib diisi"),                
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"2|Wajib diisi"),                
     "ab3"=>tatiye::val("text",$_POST["ab3"]   ,"2|Wajib diisi"),                
     "ab4"=>tatiye::val("text",$_POST["ab4"]   ,"2|Wajib diisi"),                
  ]);                                                                            
  if (empty($val["error"])) {                                                    
     $data = array(                                                              
       "title"    =>$_POST["ab1"],                                               
       "nama"    =>$_POST["ab2"],                                                
       "harga"    =>$_POST["ab3"],                                               
       "deskripsi"    =>$_POST["ab4"],                                           
       "time"   =>tatiye::tm(),                                                  
       "date"   =>tatiye::dt("EN"),                                              
       "bulan"  =>tatiye::dt("M"),                                               
       "tahun"  =>tatiye::dt("Y"),                                               
       "userid" =>$setUId,                                                       
      );                                                                         
      $result=$db->que($data)->insert("sales");                                  
      $val["hasil"]    ="sukses";                                                
      tatiye::apphistory([                                                       
        "autoload"     =>false,                                                  
        "categori"     =>"insert",                                               
         "title"        =>$_POST["ab1"],                                         
        "description"  =>"description",                                          
        "PrimaryKey"   =>0,                                                      
        "package"      =>"pricing",                                              
        "tabel"        =>"sales",                                                
      ]);                                                                        
  } else {                                                                       
      $val["hasil"]    ="error";                                                 
   };                                                                            
  #|-----------------------------------------------                              
  #| Initializes  SEGMENT UPDATE                                                 
  #|-----------------------------------------------                              
  #| Develover Tatiye.Net 2023                                                   
  #| @Date  Jumat 03 November 2023, 12:25:17 PM                                  
  } elseif ($segmen == "update") {                                               
    $val=tatiye::validation([                                                    
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"2|Wajib diisi"),                
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"2|Wajib diisi"),                
     "ab3"=>tatiye::val("text",$_POST["ab3"]   ,"2|Wajib diisi"),                
     "ab4"=>tatiye::val("text",$_POST["ab4"]   ,"2|Wajib diisi"),                
   ]);                                                                           
  if (empty($val["error"])) {                                                    
     $data = array(                                                              
       "title"    =>$_POST["ab1"],                                               
       "nama"    =>$_POST["ab2"],                                                
       "harga"    =>$_POST["ab3"],                                               
       "deskripsi"    =>$_POST["ab4"],                                           
       "time"     =>tatiye::tm(),                                                
       "date"     =>tatiye::dt("EN"),                                            
       "bulan"    =>tatiye::dt("M"),                                             
       "tahun"    =>tatiye::dt("Y"),                                             
      );                                                                         
      $result=$db->que($data)->update("sales","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                
      tatiye::apphistory([                                                       
        "autoload"     =>false,                                                  
        "categori"     =>"update",                                               
        "title"        =>$_POST["ab1"],                                          
        "description"  =>"description",                                          
        "package"      =>"pricing",                                              
        "PrimaryKey"   =>$setId,                                                 
        "tabel"        =>"sales",                                                
      ]);                                                                        
  } else {                                                                       
      $val["hasil"]    ="error";                                                 
   };                                                                            
  }                                                                              
   echo json_encode($val);                                                       
