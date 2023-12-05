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
  if (!$Root['tableHead']) {
        $Exp=array(); 
        $no=0;      
       foreach($rows[2] as $row){ 
        if (!empty($row)) {
             $IDREY=explode(' ',$row);
         foreach ($IDREY as $key => $value) {
            if (!empty($value)) {
               $no=$no+1; 
                if($no == 1) {
                  $set='NO';
                } else {
                  $set='A'.$no;
                }
               $Exp[]=$set; 
            }
         }
        }
      }                                                           
   $result=$db->que(array("tableHead"=>json_encode($Exp)))->update("sisinfo","id ='".$Root['id']."'");
 }

 // if (!$Root['sheetData']) {

            $columnDefs=array(
               [
                 'targets'=>0,
                 'className'=>'text-center',
                 "width"=> "5%"
              ],
              [
                 'targets'=>2,
                 'className'=>'text-right',
                 "width"=> "15%"
              ],
              [
                 'targets'=>3,
                 'className'=>'text-right',
                 'width'=>'30%'
              ]
   
            );

        $Exp=array(
                'sheetData'=>[
                   "Sheet A"=>[
                       "show"=>[ 1, 2,3,4,5 ],
                       "hide"=>[ 6,7,8,9,10]
                   ],
                   "Sheet B"=>[
                        "show"=>[6,7,8,9,10],
                        "hide"=>[1, 2,3,4,5]
                    ]
                ],
                "columnHide"  =>[6,7,8,9,10],
                "tabelFooter" =>false,
                "columnDefs" =>$columnDefs
               );
   $result2=$db->que(array("sheetData"=>json_encode($Exp)))->update("sisinfo","id ='".$Root['id']."'");
  
    // }
/*"tabelFooter" :["2"]
|--------------------------------------------------------------------------
| Initializes Select Tabel 
|--------------------------------------------------------------------------
| Develover Tatiye.Net 2020
| @Date 10/27/2023 4:38:24 PM
*/
unset($rows[0]);
unset($rows[1]);
unset($rows[2]);
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
   array_push($products_arr["data"],array_merge($sub_array));  
         // code...
   }
}
              
  