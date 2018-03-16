<?php 
global $wpdb;

//get the rows
$sql = "SELECT id,nom,url FROM ".$wpdb->prefix."slider";

$rows = $wpdb->get_results($sql);

?>
<form action="admin.php?page=items" method="post" id="form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float:right;">
		<a href="admin.php?page=items&act=new" id="add" class="button-primary">New</a>
	</div>
</div>
<table class="widefat">
	<thead>
		<tr>
			<th nowrap align="center" style="text-align: center;"></th>
			<th nowrap align="center" style="text-align: left;padding-left: 22px;">Name</th>
			<th nowrap align="center" style="text-align: left;">Thumbnail</th>
			<th nowrap align="center" style="width: 30px;text-align: center;">Id</th>
		</tr>
	</thead>
<tbody>
<?php        
			for($i=0; $i < count( $rows ); $i++) {
				$row = $rows[$i];
?>
				<tr>
					<td nowrap valign="middle" align="center" style="vertical-align: middle;width: 30px;" >
						<a href="admin.php?page=items&act=delete&id=<?php echo $row->id; ?>" id="add" class="button-primary">delete</a>
					</td>
					<td valign="middle" align="left" style="vertical-align: middle;padding-left: 22px;" now_w="1">
						<?php echo $row->nom; ?>
					</td>
					<td valign="middle" align="left" style="vertical-align: middle;">
						<?php echo '<img src="'.$row->url.'" style="height: 35px;" />'; ?>
					</td>
					<td valign="middle" align="center" style="vertical-align: middle;width: 30px;">
						<?php echo $row->id; ?>
					</td>
				</tr>
<?php
			} 
?>
</tbody>
</table>
</form>