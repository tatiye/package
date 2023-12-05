<?php
 use app\tatiye;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
$filename = tatiye::dir('public/drive/example.xlsx');
$spreadsheet = IOFactory::load($filename);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
unset($rows[0]);
     foreach($rows as $row){ 
      echo $row[0];
      echo $row[1];
      echo "<br>";
    }
              
?>