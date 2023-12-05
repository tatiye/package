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
  #| @Date  Jumat 27 Oktober 2023, 09:26:03 PM                                        
  if($segmen == "insert") {                                                           
  $val=tatiye::validation([                                                           
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                       
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                       
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                       
     "a4"=>tatiye::val("text",$_POST["a4"]   ,"2|Wajib diisi"),                       
     "a5"=>tatiye::val("text",$_POST["a5"]   ,"2|Wajib diisi"),                       
     "a6"=>tatiye::val("text",$_POST["a6"]   ,"2|Wajib diisi"),                       
  ]);                                                                                 
  if (empty($val["error"])) {   
   $row= tatiye::fetch($_POST["a5"],'*',"id='".$_POST["a4"]."'");                                                      
     $data = array(                                                                   
       "deskripsi"    =>$_POST["a1"],                                                 
       "nama"    =>$_POST["a2"],                                                      
       "categori"    =>$_POST["a3"],                                                  
       "keyid"    =>$_POST["a4"],                                                     
       "nmtabel"    =>$_POST["a5"],                                                   
       "package"    =>$_POST["a6"],  
       'arsip'        =>json_encode($row),                                                 
       "time"   =>tatiye::tm(),                                                       
       "date"   =>tatiye::dt("EN"),                                                   
       "bulan"  =>tatiye::dt("M"),                                                    
       "tahun"  =>tatiye::dt("Y"),                                                    
       "userid" =>$setUId,                                                            
      );                                                                              
      $result=$db->que($data)->insert("apparchive");                                  
      $val["hasil"]    ="sukses";                                                     
      tatiye::apphistory([                                                            
        "autoload"     =>false,                                                       
        "categori"     =>"insert",                                                    
         "title"        =>$_POST["a1"],                                               
        "description"  =>"description",                                               
        "PrimaryKey"   =>0,                                                           
        "package"      =>"devices",                                                   
        "tabel"        =>"apparchive",                                                
      ]);                                                                             
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  #|-----------------------------------------------                                   
  #| Initializes  SEGMENT UPDATE                                                      
  #|-----------------------------------------------                                   
  #| Develover Tatiye.Net 2023                                                        
  #| @Date  Jumat 27 Oktober 2023, 09:26:03 PM                                        
  } elseif ($segmen == "update") {                                                    
    $val=tatiye::validation([                                                         
     "a1"=>tatiye::val("text",$_POST["a1"]   ,"2|Wajib diisi"),                       
     "a2"=>tatiye::val("text",$_POST["a2"]   ,"2|Wajib diisi"),                       
     "a3"=>tatiye::val("text",$_POST["a3"]   ,"2|Wajib diisi"),                       
     "a4"=>tatiye::val("text",$_POST["a4"]   ,"2|Wajib diisi"),                       
     "a5"=>tatiye::val("text",$_POST["a5"]   ,"2|Wajib diisi"),                       
     "a6"=>tatiye::val("text",$_POST["a6"]   ,"2|Wajib diisi"),                       
   ]);                                                                                
  if (empty($val["error"])) {                                                         
     $data = array(                                                                   
       "deskripsi"    =>$_POST["a1"],                                                 
       "nama"    =>$_POST["a2"],                                                      
       "categori"    =>$_POST["a3"],                                                  
       "keyid"    =>$_POST["a4"],                                                     
       "nmtabel"    =>$_POST["a5"],                                                   
       "package"    =>$_POST["a6"],                                                   
       "time"     =>tatiye::tm(),                                                     
       "date"     =>tatiye::dt("EN"),                                                 
       "bulan"    =>tatiye::dt("M"),                                                  
       "tahun"    =>tatiye::dt("Y"),                                                  
      );                                                                              
      $result=$db->que($data)->update("apparchive","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                     
      tatiye::apphistory([                                                            
        "autoload"     =>false,                                                       
        "categori"     =>"update",                                                    
        "title"        =>$_POST["a1"],                                                
        "description"  =>"description",                                               
        "package"      =>"devices",                                                   
        "PrimaryKey"   =>$setId,                                                      
        "tabel"        =>"apparchive",                                                
      ]);                                                                             
  } else {                                                                            
      $val["hasil"]    ="error";                                                      
   };                                                                                 
  }                                                                                   
   echo json_encode($val);                                                            
