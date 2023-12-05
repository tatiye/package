<?php
    use app\tatiye;
    $row= tatiye::fetch('demo','*',"id='".$_POST['key']."'");  
      $Header = [
      [
          'title'  =>'Jl.Trans Sulawesi Bunt.Tengah',
      ],
      [
          'title'  =>'Kabupaten Pohuwato ',
      ],
      [
          'title'  => '==================================',
      ],
  ];
          $body[]=array(
           
               " NAMA       "=>':'.$row['nama'],
               "            "=>'',
 
          );
    $footer = [
      [
          'title' => 'ARSIP STRUK PELUNASAN',
          'author' =>'',
      ],
      [
          'title' => 'TERIMAKASIH ',
          'author' =>'',
      ]
  ];
?>
<?php tatiye::tabelRawset($body,$Header,$footer);?> 

