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
  #| @Date  Senin 06 November 2023, 03:50:17 PM                                  
  if($segmen == "insert") {                                                      
  $val=tatiye::validation([                                                      
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"1|Wajib diisi"),                  
     "b2"=>tatiye::val("text",$_POST["b2"]   ,"1|Wajib diisi"),                  
     "b3"=>tatiye::val("text",$_POST["b3"]   ,"1|Wajib diisi"),                  
  ]);                                                                            
  if (empty($val["error"])) {                                                    
     $data = array(                                                              
       "nama"    =>$_POST["b1"],                                                 
       "harga"    =>$_POST["b2"],                                                
       "jumlah"    =>$_POST["b3"],                                                
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
         "title"        =>$_POST["b1"],                                          
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
  #| @Date  Senin 06 November 2023, 03:50:17 PM                                  
  } elseif ($segmen == "update") {                                               
    $val=tatiye::validation([                                                    
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"1|Wajib diisi"),                  
     "b2"=>tatiye::val("text",$_POST["b2"]   ,"1|Wajib diisi"),                  
     "b3"=>tatiye::val("text",$_POST["b3"]   ,"1|Wajib diisi"),                  
   ]);                                                                           
  if (empty($val["error"])) {                                                    
     $data = array(                                                              
       "nama"    =>$_POST["b1"],                                                 
       "harga"    =>$_POST["b2"],                                                
       "jumlah"    =>$_POST["b3"],                                                
       "time"     =>tatiye::tm(),                                                
       "date"     =>tatiye::dt("EN"),                                            
       "bulan"    =>tatiye::dt("M"),                                             
       "tahun"    =>tatiye::dt("Y"),                                             
      );                                                                         
      $result=$db->que($data)->update("biling","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                
      tatiye::apphistory([                                                       
        "autoload"     =>false,                                                  
        "categori"     =>"update",                                               
        "title"        =>$_POST["b1"],                                           
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
