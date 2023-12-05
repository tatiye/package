<?php                                                                                
  use app\tatiye;                                                               
  $Text=tatiye::Text();                                                         
  $db=new tatiye();       
 //$_SERVER['HTTP_AUTHORIZATION']                                  
  $setId=$_SERVER['HTTP_KEY'];                                                         
  $setUId=tatiye::uidkey();                                                     
  if (is_numeric($setId)) {                                              
   $segmen="update";                                                            
  } else {                                                                      
   $segmen="insert";                                                            
  }                                                                                     
  #|-------------------------------------                                                
  #| Initializes SEGMENT INSERT                                                          
  #|-------------------------------------                                                
  #| Develover Tatiye.Net 2023                                                           
  #| @Date  Selasa 22 Agustus 2023, 07:36:17 AM                                          
 if ($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                          
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "filename"    =>$_POST["a1"],                                                     
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                        
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  }                                                                                      
   echo json_encode($val);                                                               
