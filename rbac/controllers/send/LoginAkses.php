<?php                                                                                   
  use app\tatiye;                                                                  
  $Text=tatiye::Text();                                                            
  $db=new tatiye();                                                                
  $setId=$_SERVER["HTTP_KEY"];                                                     
  $setUId=$_SERVER["HTTP_USERID"];    
  $IDuser= tatiye::fetch('appuserprofil','*',"id='".$setId."' ORDER BY id DESC");
  $IDTemp=$IDuser['userid'];
  if (is_numeric($setId)) {                                                        
   $segmen="update";                                                               
  } else {                                                                         
   $segmen="insert";                                                               
  }                                                                                
  #|-------------------------------------                                          
  #| Initializes SEGMENT INSERT                                                    
  #|-------------------------------------                                          
  #| Develover Tatiye.Net 2023                                                     
  #| @Date  Senin 18 September 2023, 04:23:56 PM                                   
  if ($segmen == "update") {                                                 
    $val=tatiye::validation([                                                      
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"1|Wajib diisi"),                    
   ]);                        
   if ($_POST["a1"] == 'On') {
      $login=0;
    } else {
      $login=3;
    }
                                                                                                             
  if (empty($val["error"])) {                                                      
     $data = array(                                                                
       "loginattempts"    =>$login,                                                       
                                            
      );                                                                           
      $result=$db->que($data)->update("appuser","id =$IDTemp");  
      $val["hasil"]    ="sukses";                                                  
  } else {                                                                         
      $val["hasil"]    ="error";                                                   
   };                                                                              
  }                                                                                
   echo json_encode($val);                                                         
