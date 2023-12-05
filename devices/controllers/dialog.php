<?php
 use app\tatiye;
 if ($_POST['tabel']=='apparchive') {
    $var=tatiye::fetch('apparchive',"arsip,package","id='".$_POST['key']."'");
    $variable = json_decode($var['arsip'], true);
    $label=true;
  } elseif ($_POST['tabel']=='appsampah'){
    $var=tatiye::fetch('appsampah',"arsip,package","id='".$_POST['key']."'");
    $variable = json_decode($var['arsip'], true);
    $label=true;
 } else {
    $variable=tatiye::fetch($_POST['tabel'],"*","id='".$_POST['key']."'");
    $label=false;
 }
 $row=tatiye::fetchUserID($variable["userid"]); 
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 mb-10px">
      <div class="list-group-item d-flex align-items-center">
  <img src="<?=$row['avatar'];?>" class="wd-30 rounded-circle mg-r-15" alt="">
  <div>
    <h6 class="tx-13 tx-inverse tx-semibold mg-b-0"><?=$row['name'];?></h6>
    <span class="d-block tx-11 text-muted">User Data</span>
  </div>
</div>
    </div>
    <div class="col-md-12">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Label</th>
      <th scope="col">Value</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=0;
    foreach ($variable as $key => $value) {
    if (!empty($value)) {
    if ($key !=='id' 
      && $key !=='row'  
      && $key !=='userid' 
      && $key !=='bulan' 
      && $key !=='tahun' 
      && $key !=='user_id') {
    $no=$no+1;
     ?>
    <tr>
      <th style="width:30px" scope="row"><?=$no;?></th>
      <th  style="width:120px" class="text-capitalize"><?=$key;?></th>
      <td><?=$value;?></td>
    </tr>
   <?php } } }?>
   <?php 
  if (!empty($label)) {?>
    <tr>
      <th style="width:30px" scope="row"><?=$no+1;?></th>
      <th>Package</th>
      <td><?=$var['package'];?></td>
    </tr> 
  <?php }?>
  </tbody>
</table>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>