<?php
include_once('./_common.php');

if(isset($_POST['postcode'])) {
  $postcode = $_POST['postcode'];

  header('Content-Type: application/json');

  $available = false;

  $sql = " select *
                from {$g5['g5_shop_delivery_area_table']}
                where sb_postcode = '$postcode'
                  and sb_available = '1'";

  $result = sql_query($sql);

  $list = array();
  for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row['sb_suburb'].', '.$row['sb_state'];
  }
  if (count($list) > 0) $available = true;

  $data = array('result' => $available, 'list' => $list);

  echo json_encode($data);
}

?>
