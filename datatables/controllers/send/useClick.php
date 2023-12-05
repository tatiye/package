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
  #| @Date  Jumat 13 Oktober 2023, 08:50:42 PM                                  
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"2|Wajib diisi"),               
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"2|Wajib diisi"),               
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["ab1"],                                               
       "title"    =>$_POST["ab2"],                                              
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
  #| @Date  Jumat 13 Oktober 2023, 08:50:42 PM                                  
  } elseif ($segmen == "update") {                                              
    $val=tatiye::validation([                                                   
     "ab1"=>tatiye::val("text",$_POST["ab1"]   ,"2|Wajib diisi"),               
     "ab2"=>tatiye::val("text",$_POST["ab2"]   ,"2|Wajib diisi"),               
   ]);                                                                          
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"    =>$_POST["ab1"],                                               
       "title"    =>$_POST["ab2"],                                              
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
