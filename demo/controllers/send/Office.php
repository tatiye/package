<?php                                                                                                   
  use app\tatiye;                                                                                  
  use PhpOffice\PhpSpreadsheet\Reader\Xlsx;                                                        
  $Text=tatiye::Text();                                                                            
  $db=new tatiye();                                                                                
  $setUId=$_SESSION["user_id"];                                                                    
  $excelMimes = array(                                                                             
    "text/xls",                                                                                    
    "text/xlsx",                                                                                   
    "application/excel",                                                                           
    "application/vnd.msexcel",                                                                     
    "application/vnd.ms-excel",                                                                    
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"                            
  );                                                                                               
  if(!empty($_FILES["filename"]["name"]) && in_array($_FILES["filename"]["type"], $excelMimes)){   
    if(is_uploaded_file($_FILES["filename"]["tmp_name"])){                                         
      $reader = new Xlsx();                                                                        
      $spreadsheet = $reader->load($_FILES["filename"]["tmp_name"]);                               
      $worksheet = $spreadsheet->getActiveSheet();                                                 
      $worksheet_arr = $worksheet->toArray();                                                      
      unset($worksheet_arr[0]);                                                                    
      foreach($worksheet_arr as $row){                                                             
      $data = array(                                                                               
       "nama"    =>$row[0],                                                                        
       "title"    =>$row[1],                                                                       
       "Provinsi"    =>$row[2],                                                                    
       "time"   =>tatiye::tm(),                                                                    
       "date"   =>tatiye::dt("EN"),                                                                
       "bulan"  =>tatiye::dt("M"),                                                                 
       "tahun"  =>tatiye::dt("Y"),                                                                 
       "userid" =>$setUId,                                                                         
      );                                                                                           
      $result=$db->que($data)->insert("demo");                                                     
    }                                                                                              
       $val["hasil"]    ="sukses";                                                                 
    }else{                                                                                         
       $val["hasil"]    ="error";                                                                  
    }                                                                                              
  }                                                                                                
  echo json_encode($val);                                                                          
                                                                                                   
