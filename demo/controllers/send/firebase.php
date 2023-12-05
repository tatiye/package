<?php                                                                                
  use app\tatiye;                                                               
  $Text=tatiye::Text();                                                         
  $db=new tatiye();                                                             
  $setId=$_SERVER["HTTP_KEY"];                                                  
  $setUId=$_SERVER["HTTP_USERID"];                                              
  $fireid=$_SERVER["HTTP_FIREID"];                                              
  if (is_numeric($setId)) {                                                     
   $segmen="update";                                                            
  } else {                                                                      
   $segmen="insert";                                                            
  }                                                                             
  #|-------------------------------------                                       
  #| Initializes SEGMENT INSERT                                      
  #|-------------------------------------                                       
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Minggu 05 November 2023, 02:52:57 AM                                
  if($segmen == "insert") {                                                     
  $val=tatiye::validation([                                                     
     "b1"=>tatiye::val("text",$_POST["b1"]   ,"2|Wajib diisi"),                 
  ]);                                                                           
  if (empty($val["error"])) {                                                   
     $data = array(                                                             
       "nama"   =>$_POST["b1"],                                                
       "fireid" =>$fireid,                                                
       "time"   =>tatiye::tm(),                                                 
       "date"   =>tatiye::dt("EN"),                                             
       "bulan"  =>tatiye::dt("M"),                                              
       "tahun"  =>tatiye::dt("Y"),                                              
       "userid" =>$setUId,                                                      
      );                                                                        
      $result=$db->que($data)->insert("demo");                                  
      $val["hasil"]    ="sukses";                                               
      tatiye::apphistory([                                                      
        "autoload"     =>false,                                                 
        "categori"     =>"insert",                                              
         "title"        =>$_POST["b1"],                                         
        "description"  =>"description",                                         
        "PrimaryKey"   =>0,                                                     
        "package"      =>"demo",                                                
        "tabel"        =>"demo",                                                
      ]);                                                                       
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  #|-----------------------------------------------                             
  #| Initializes  SEGMENT UPDATE                                                
  #|-----------------------------------------------                             
  #| Develover Tatiye.Net 2023                                                  
  #| @Date  Minggu 05 November 2023, 02:52:57 AM                                
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
      $result=$db->que($data)->update("demo","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                               
      tatiye::apphistory([                                                      
        "autoload"     =>false,                                                 
        "categori"     =>"update",                                              
        "title"        =>$_POST["b1"],                                          
        "description"  =>"description",                                         
        "package"      =>"demo",                                                
        "PrimaryKey"   =>$setId,                                                
        "tabel"        =>"demo",                                                
      ]);                                                                       
  } else {                                                                      
      $val["hasil"]    ="error";                                                
   };                                                                           
  }                                                                             
   echo json_encode($val);                                                      
