<?php                                                                                
  use app\tatiye;                                                               
  $Text=tatiye::Text();                                                         
  $db=new tatiye();                                                             
  $setId=$_POST["key"];                                                         
  $setUId=tatiye::uidkey();                                                     
  if (is_numeric($_POST["key"])) {                                              
   $segmen="update";                                                            
  } else {                                                                      
   $segmen="insert";                                                            
  }                                                                             
  #|-------------------------------------                                       
  #| Initializes SEGMENT INSERT                                                 
  #|-------------------------------------                                       
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Kamis 17 Agustus 2023, 05:17:21 PM                                  
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"2|Wajib diisi"),                 
     "b2"=>tatiye::val("text",$_POST["b2"]   ,"2|Wajib diisi"),                 
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["b1"],                                                
       "title"    =>$_POST["b2"],                                               
       "time"     =>tatiye::tm(),                                               
       "date"     =>tatiye::dt("EN"),                                           
       "bulan"    =>tatiye::dt("M"),                                            
       "tahun"    =>tatiye::dt("Y"),                                            
       "userid"  =>tatiye::uidkey(),                                            
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
  #| @Date  Kamis 17 Agustus 2023, 05:17:21 PM                                  
  } elseif ($segmen == "update") {                                              
    $val=tatiye::validation([                                                   
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"2|Wajib diisi"),                 
     "b2"=>tatiye::val("text",$_POST["b2"]   ,"2|Wajib diisi"),                 
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["b1"],                                                
       "title"    =>$_POST["b2"],                                               
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
