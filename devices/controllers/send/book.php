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
  #| @Date  Rabu 27 September 2023, 05:04:41 PM                                       
  if($segmen == "insert") {                                                           
  $val=tatiye::validation([                                                           
     "boo1"=>tatiye::val("text",$_POST["boo1"]   ,"2|Wajib diisi"),                   
     "boo2"=>tatiye::val("text",$_POST["boo2"]   ,"2|Wajib diisi"),                   
     "boo3"=>tatiye::val("text",$_POST["boo3"]   ,"2|Wajib diisi"),                   
     "boo4"=>tatiye::val("text",$_POST["boo4"]   ,"2|Wajib diisi"),                   
  ]);                                                                                 
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "nama"    =>$_POST["boo1"],                                                    
       "deskripsi"    =>$_POST["boo2"],                                               
       "categori"    =>$_POST["boo3"],                                                
       "bookmark"    =>$_POST["boo4"],                                                
       "time"   =>tatiye::tm(),                                                       
       "date"   =>tatiye::dt("EN"),                                                   
       "bulan"  =>tatiye::dt("M"),                                                    
       "tahun"  =>tatiye::dt("Y"),                                                    
       "userid" =>$setUId,                                                            
      );                                                                              
      $result=$db->que($data)->insert("apparchive");                                  
      $val["hasil"]    ="sukses";                                                     
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  #|-----------------------------------------------                                   
  #| Initializes  SEGMENT UPDATE                                                      
  #|-----------------------------------------------                                   
  #| Develover Tatiye.Net 2023                                                        
  #| @Date  Rabu 27 September 2023, 05:04:41 PM                                       
  } elseif ($segmen == "update") {                                                    
    $val=tatiye::validation([                                                         
     "boo1"=>tatiye::val("text",$_POST["boo1"]   ,"2|Wajib diisi"),                   
     "boo2"=>tatiye::val("text",$_POST["boo2"]   ,"2|Wajib diisi"),                   
     // "boo3"=>tatiye::val("text",$_POST["boo3"]   ,"2|Wajib diisi"),                   
     "boo4"=>tatiye::val("text",$_POST["boo4"]   ,"2|Wajib diisi"),                   
   ]);                                                                                
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "nama"    =>$_POST["boo1"],                                                    
       "deskripsi"    =>$_POST["boo2"],                                               
       // "categori"    =>$_POST["boo3"],                                                
       "bookmark"    =>$_POST["boo4"],                                                
       "time"     =>tatiye::tm(),                                                     
       "date"     =>tatiye::dt("EN"),                                                 
       "bulan"    =>tatiye::dt("M"),                                                  
       "tahun"    =>tatiye::dt("Y"),                                                  
      );                                                                              
      $result=$db->que($data)->update("apparchive","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                     
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  }                                                                                   
   echo json_encode($val);                                                            
