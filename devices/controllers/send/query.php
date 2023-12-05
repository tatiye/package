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
  #| @Date  Rabu 25 Oktober 2023, 11:22:37 AM                                        
  if($segmen == "insert") {                                                          
  $val=tatiye::validation([                                                          
     "q1"=>tatiye::val("text",$_POST["q1"]   ,"2|Wajib diisi"),                      
  ]);                                                                                
  if (empty($val["error"])) {                                                        
     $data = array(                                                                  
       "setQuery"    =>$_POST["q1"],                                                 
       "time"   =>tatiye::tm(),                                                      
       "date"   =>tatiye::dt("EN"),                                                  
       "bulan"  =>tatiye::dt("M"),                                                   
       "tahun"  =>tatiye::dt("Y"),                                                   
       "userid" =>$setUId,                                                           
      );                                                                             
      $result=$db->que($data)->insert("appoffice");                                  
      $val["hasil"]    ="sukses";                                                    
      tatiye::apphistory([                                                           
        "autoload"     =>false,                                                      
        "categori"     =>"insert",                                                   
         "title"        =>$_POST["q1"],                                              
        "description"  =>"description",                                              
        "PrimaryKey"   =>0,                                                          
        "package"      =>"devices",                                                  
        "tabel"        =>"appoffice",                                                
      ]);                                                                            
  } else {                                                                           
      $val["hasil"]    ="error";                                                     
   };                                                                                
  #|-----------------------------------------------                                  
  #| Initializes  SEGMENT UPDATE                                                     
  #|-----------------------------------------------                                  
  #| Develover Tatiye.Net 2023                                                       
  #| @Date  Rabu 25 Oktober 2023, 11:22:37 AM                                        
  } elseif ($segmen == "update") {                                                   
    $val=tatiye::validation([                                                        
     "q1"=>tatiye::val("text",$_POST["q1"]   ,"2|Wajib diisi"),                      
   ]);                                                                               
  if (empty($val["error"])) {                                                        
     $data = array(                                                                  
       "setQuery"    =>$_POST["q1"],                                                 
       "time"     =>tatiye::tm(),                                                    
       "date"     =>tatiye::dt("EN"),                                                
       "bulan"    =>tatiye::dt("M"),                                                 
       "tahun"    =>tatiye::dt("Y"),                                                 
      );                                                                             
      $result=$db->que($data)->update("appoffice","id =$setId AND userid=$setUId");  
      $val["hasil"]    ="sukses";                                                    
      tatiye::apphistory([                                                           
        "autoload"     =>false,                                                      
        "categori"     =>"update",                                                   
        "title"        =>$_POST["q1"],                                               
        "description"  =>"description",                                              
        "package"      =>"devices",                                                  
        "PrimaryKey"   =>$setId,                                                     
        "tabel"        =>"appoffice",                                                
      ]);                                                                            
  } else {                                                                           
      $val["hasil"]    ="error";                                                     
   };                                                                                
  }                                                                                  
   echo json_encode($val);                                                           
