<?php
 use app\tatiye;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
$filename = tatiye::dir('public/'.$RootFile['filename']);
$spreadsheet = IOFactory::load($filename);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
$db=new tatiye();
/*
|--------------------------------------------------------------------------
| Initializes Head Tabel 
|--------------------------------------------------------------------------
| Develover Tatiye.Net 2020
| @Date 10/27/2023 4:38:24 PM
*/
if (!empty($Root['tableHead'])) {
       $str='[';       
       foreach($rows[0] as $row){ 
        if (!empty($row)) {
             $IDREY=explode(' ',$row);
         foreach ($IDREY as $key => $value) {
            if (!empty($value)) {
               $str=$str.'"'.$value.'",';
            }
         }
        }
      }
   $str = substr($str, 0, -1).']';                                                              
   $result=$db->que(array("tableHead"=>$str))->update("sisinfo","id ='".$Root['id']."'");
}
/*
|--------------------------------------------------------------------------
| Initializes Select Tabel 
|--------------------------------------------------------------------------
| Develover Tatiye.Net 2020
| @Date 10/27/2023 4:38:24 PM
*/
unset($rows[0]);
unset($rows[1]);
$number=0;  
foreach($rows as $row){ 
   if (!empty($row[1])) {
   $number=$number+1;  
   $sub_array   =array();  
   $sub_array[] =$number;   
   //$sub_array[] =$row[0];  
   $sub_array[] =$row[1];  
   $sub_array[] =$row[2];  
   $sub_array[] =$row[3];  
   $sub_array[] =$row[4];  
   $sub_array[] =$row[5];  
   $sub_array[] =$row[6];  
   $sub_array[] =$row[7];  
   $sub_array[] =$row[8];  
   $sub_array[] =$row[9];  
   $sub_array[] =$row[10];  
   $sub_array[] =$row[11];  
   $sub_array[] =$row[12];  
   $sub_array[] =$row[13];  
   $sub_array[] =$row[14];  
   $sub_array[] =$row[15];  
   $sub_array[] =$row[16]; 
   $sub_array[] =$row[17];  
   $sub_array[] =$row[18];  
   $sub_array[] =$row[19];  
   $sub_array[] =$row[20];  
   $sub_array[] =$row[21];  
   $sub_array[] =$row[22];  
   $sub_array[] =$row[23];  
   $sub_array[] =$row[24];  
   $sub_array[] =$row[25];  
   $sub_array[] =$row[26];  
   $sub_array[] =$row[27];  
   $sub_array[] =$row[28];  
   $sub_array[] =$row[29];  
   $sub_array[] =$row[30];  
   $sub_array[] =$row[31];  
   $sub_array[] =$row[32]; 
   $sub_array[] =$row[33]; 
   $sub_array[] =$row[34]; 
   $sub_array[] =$row[35]; 
   $sub_array[] =$row[36]; 
   $sub_array[] =$row[37]; 
   $sub_array[] =$row[38]; 
   $sub_array[] =$Root['archive'];  
   array_push($products_arr["data"],array_merge($sub_array));  
         // code...
   }
}
              
  