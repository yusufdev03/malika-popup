<?php
// Template Dashboard Malika Popup
$exampleListTable = new Example_List_Table();
$exampleListTable->prepare_items();
?>

<div class="wrap">
  <h1>Dashboard Popup</h1>
  <p>Email Registered</p>
  <?php 
	$id_popup = malika_get_id_post();
	$exampleListTable->display();
  ?>
</div>