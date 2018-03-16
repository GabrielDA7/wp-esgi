<?php
global $wpdb;
$sql = "SELECT id,nom,url FROM ".$wpdb->prefix."slider";

$rows = $wpdb->get_results($sql);
?>
<section class="slider" class="container-fluid">
  <?php
  for($i=0; $i < count( $rows ); $i++) {
        $row = $rows[$i];
        echo '<img class="mySlides" src="'.$row->url.'">';
      }
  ?>
  <a href="" id="slider-left"><</i></a>
  <a href="" id="slider-right">></i></a>
</section>