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
  #| @Date  Jumat 22 September 2023, 12:05:30 PM                                         
  if($segmen == "update") {                                                       
    $val=tatiye::validation([                                                            
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                          
   ]);                                                                                   
  if (empty($val["error"])) {                                                            
     $data = array(                                                                      
       "status"    =>$_POST["a1"],                                                       
       "time"     =>tatiye::tm(),                                                        
       "date"     =>tatiye::dt("EN"),                                                    
       "bulan"    =>tatiye::dt("M"),                                                     
       "tahun"    =>tatiye::dt("Y"),                                                     
      );                                                                                 
      $result=$db->que($data)->update("appuserprofil","id =$setId ");  
      // $result=$db->que($data)->update("appuserprofil","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                        
  } else {                                                                               
      $val["hasil"]    ="error";                                                         
   };                                                                                    
  }                                                                                      
   echo json_encode($val);                                                               
