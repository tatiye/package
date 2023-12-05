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
  <div id="headertd" style="margin-bottom: 150px;">
   <img src="<?=tatiye::images($arr['app']['logo']);?>" width="80">
   <div style="font-size:24px;font-weight:bold"><?=$decode['header']['title'];?></div>
   <div style="font-size:21px;"><?=$decode['header']['deskripsi'];?></div>
   <div style="font-size:18px;"><?=$decode['header']['addres'];?></div>
  <hr>
  </div>
  <br>
  <div><?=$READ['deskripsi'];?></div>
            <?php 
               if (!empty($READ['setTabel'])) {
               ?>
                <div class="detail" style="width:100%;">
                    <table id="tbDetail" cellpadding="0" cellspacing="0" width="100%" style="font-size: 11.5px">
                        <thead>
                            <tr class="detail-header">
                              <?php 
                               foreach ($decode['tableHead'] as $key => $value) {
                                echo '<td class="br-1 bb-1 bt-1 center bold '.$decode['classTd'][$key].'" style="width:'.$decode['widthHead'][$key].'">'.$value.'</td>';
                               }
                               ?>
                            </tr>
                        </thead>
                        <tbody>
                              <?php 
                               foreach ($products_arr["data"] as $key => $value) {?>
                                <tr class="detail-data text-left">
                                   <?php 
                                    foreach ($decode['tableHead'] as $num => $row) {
                                      echo '<td class="br-1 bb-1 bt-1 '.$decode['classTd'][$num].'">'.$value[$num].'</td>';
                                    }?>
                                </tr>
                              <?php }?>
                        </tbody>
                    </table>
                </div>
              <?php }?>
            
        <footer>
            Copyright &copy; <?=$arr['app']['sitename'];?> | Date Prind :<?=tatiye::dt("EN");?> 
        </footer>
            <style>
           @page {
                margin: 100px 25px;
            }
     
            #headertd {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                text-align:center;
                color: 000;
            }
                  #headertd img{
                    padding-top: 10px;
                    position :absolute;
                    width:50px;
                  }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 20px; 
                color: #000;
                line-height: 35px;
                font-size:12px;
            }



                #tbDetail {
                border-style: solid;
                border-color: #776b6b;
                border-width: 0.7px;
                border-collapse: collapse;
                line-height: 16px;
                }
                #tbDetail td {
                border-style: solid;
                border-color: #776b6b;
                border-width: 0.7px;
                padding: 2px;
                }
                #tbDetail .detail-data td {
                border-style: none solid dotted none;
                }
                #tbDetail tr td span {
                display: inline-block;
                text-align: center;
                }
                .bt-1{
                border-top: 1px solid #776b6b;
                }
                .br-1 {
                border-right: 1px solid #776b6b;
                }
                .bb-1 {
                border-bottom: 1px solid #776b6b;
                }
                .text-center{
                  text-align:center;
                }
                 .center{
                  text-align:center;
                }
                 .right{
                  text-align:right;
                }
                .bold{
                  font-weight: bold;
                }
            </style>