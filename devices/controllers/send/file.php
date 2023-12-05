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
  #| @Date  Senin 09 Oktober 2023, 04:20:32 PM                                     
  if($segmen == "insert") {                                                        
  $val=tatiye::validation([                                                        
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"2|Wajib diisi"),                    
  ]);                                                                              
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "nama"    =>$_POST["b1"],                                                   
       "time"   =>tatiye::tm(),                                                    
       "date"   =>tatiye::dt("EN"),                                                
       "bulan"  =>tatiye::dt("M"),                                                 
       "tahun"  =>tatiye::dt("Y"),                                                 
       "userid" =>$setUId,                                                         
      );                                                                           
      $result=$db->que($data)->insert("appfile");                                  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  #|-----------------------------------------------                                
  #| Initializes  SEGMENT UPDATE                                                   
  #|-----------------------------------------------                                
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 09 Oktober 2023, 04:20:32 PM                                     
  } elseif ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"2|Wajib diisi"),                    
   ]);                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "nama"    =>$_POST["b1"],                                                   
       "time"     =>tatiye::tm(),                                                  
       "date"     =>tatiye::dt("EN"),                                              
       "bulan"    =>tatiye::dt("M"),                                               
       "tahun"    =>tatiye::dt("Y"),                                               
      );                                                                           
      $result=$db->que($data)->update("appfile","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  }                                                                                
   echo json_encode($val);                                                         
