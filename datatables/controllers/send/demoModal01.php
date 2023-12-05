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
  #| @Date  Rabu 27 September 2023, 11:07:21 PM                                 
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                 
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                 
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["a1"],                                                
       "title"    =>$_POST["a2"],                                               
       "time"   =>tatiye::tm(),                                                 
       "date"   =>tatiye::dt("EN"),                                             
       "bulan"  =>tatiye::dt("M"),                                              
       "tahun"  =>tatiye::dt("Y"),                                              
       "userid" =>$setUId,                                                      
      );                                                                        
      $result=$db->que($data)->insert("demo");                                  
      $val["hasil"]    ="sukses";                                               
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  #|-----------------------------------------------                             
  #| Initializes  SEGMENT UPDATE                                                
  #|-----------------------------------------------                             
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Rabu 27 September 2023, 11:07:21 PM                                 
  } elseif ($segmen == "update") {                                              
    $val=tatiye::validation([                                                   
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                 
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                 
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["a1"],                                                
       "title"    =>$_POST["a2"],                                               
       "time"     =>tatiye::tm(),                                               
       "date"     =>tatiye::dt("EN"),                                           
       "bulan"    =>tatiye::dt("M"),                                            
       "tahun"    =>tatiye::dt("Y"),                                            
      );                                                                        
      $result=$db->que($data)->update("demo","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                               
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  }                                                                             
   echo json_encode($val);                                                      
