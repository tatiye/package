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
  #| @Date  Rabu 27 September 2023, 12:13:08 PM                                       
  if($segmen == "insert") {                                                           
  $val=tatiye::validation([                                                           
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                       
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                       
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                       
     "a4"=>tatiye::val("text",$_POST["a4"]   ,"2|Wajib diisi"),                       
     "a5"=>tatiye::val("text",$_POST["a5"]   ,"2|Wajib diisi"),                       
  ]);                                                                                 
  if (empty($val["error"])) { 
  $row= tatiye::fetch($_POST["a5"],'*',"id='".$_POST["a4"]."'");
                                                     
     $data = array(                                                                   
       "deskripsi"   =>$_POST["a1"],  
       'arsip'       =>json_encode($row),                                                  
       "nama"        =>$_POST["a2"],                                                      
       "categori"    =>$_POST["a3"],                                                  
       "keyid"       =>$_POST["a4"],                                                     
       "nmtabel"     =>$_POST["a5"],                                                   
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
  #| @Date  Rabu 27 September 2023, 12:13:08 PM                                       
  } elseif ($segmen == "update") {                                                    
    $val=tatiye::validation([                                                         
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                       
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                       
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                       
     "a4"=>tatiye::val("text",$_POST["a4"]   ,"2|Wajib diisi"),                       
     "a5"=>tatiye::val("text",$_POST["a5"]   ,"2|Wajib diisi"),                       
   ]);                                                                                
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "deskripsi"    =>$_POST["a1"],                                                 
       "nama"         =>$_POST["a2"],                                                      
       "categori"    =>$_POST["a3"],                                                                                              
       "nmtabel"    =>$_POST["a5"],                                                   
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
