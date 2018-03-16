
<div id="wpcis_content">
	<?php
		$page=$_GET['page'];
		if($page == 'slideresgi')
			include('overview.php');
		elseif($page == 'items') {
			$act=$_GET['act'];
			if($act == '')
				include('items.php');
			elseif($act == 'new' || $act == 'edit')
				include('item.php');
			elseif($act == 'save' || $act == 'delete')
				include ('database.php');
		} elseif($page == 'slider') {
			include ('slider.php');
		}
	?>
</div>
