<?php
    use app\tatiye;
    $READ=tatiye::fetch("appoffice","*","id='".$_GET['tn']."'");
    $decode=json_decode($READ['setProperty'], true);
      $setApp = file_get_contents(tatiye::expDir('public/theme/package.json'));
     $arr = json_decode($setApp, true);
    // $row=tatiye::useHandelID('demo','id',$_GET['tn']);   
    if (!empty($READ['setTabel'])) {
      $row= tatiye::fetch($READ['nmtabel'],'*',"id='".$_GET['tn']."'");
      $QUERY=$READ['setTabel'];
      $number=0;                                                            
      $products_arr["data"]=array();                                        
      $variable=tatiye::QY($QUERY);                                         
      while ($row = $variable->fetch(PDO::FETCH_NUM)) {                                   
        $number=$number+1;                                                  
        $sub_array   = array();                                               
        $sub_array[] =$number;                                              
        array_push($products_arr["data"],array_merge($sub_array,$row));  
      } 
    }
    ?>
    <?=$READ['deskripsi'];?>
  <table  cellpadding="0" cellspacing="0">
    <thead>
        <tr>
          <?php 
           foreach ($decode['tableHead'] as $key => $value) {
            echo '<td style="width:'.$decode['widthHead'][$key].'">'.$value.'</td>';
           }
           ?>
        </tr>
    </thead>
    <tbody>
          <?php 
           foreach ($products_arr["data"] as $key => $value) {?>
            <tr>
               <?php 
                foreach ($decode['tableHead'] as $num => $row) {
                  echo '<td>'.$value[$num].'</td>';
                }?>
            </tr>
          <?php }?>
    </tbody>
</table>