<?php
 use app\tatiye;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
$filename = tatiye::dir('public/drive/example.xlsx');
$spreadsheet = IOFactory::load($filename);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
unset($rows[0]);
$number=0;  
foreach($rows as $row){ 
   $number=$number+1;  
   $sub_array   =array();  
   $sub_array[] =$number;   
   $sub_array[] =$row[0];  
   $sub_array[] =$row[1];  
   $sub_array[] =$Root['archive'];  
   array_push($products_arr["data"],array_merge($sub_array));  
}
              
  