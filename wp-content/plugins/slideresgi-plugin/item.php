<form action="admin.php?page=items&act=save" method="post" id="form">
<div style="overflow: hidden;margin: 0 0 10px 0;">
	<div style="float:right;">
		<button  id="form_save" class="button-primary">Save</button>
		<a href="admin.php?page=items" class="button">Cancel</a>
	</div>
</div>
<div id="c_div">
	<div>
		<table cellpadding="0" cellspacing="0" style="width: 100%;">
			<tr>
				<td style="width: 420px;vertical-align: top;" align="top">
					<div><label for="nom">Nom</label></div>
					<div><input type="text" name="nom" id="nom" size="40"></div>		
					<div style="clear: both;height: 5px;"></div>
					<div><label for="url">Image</label></div>
					<input type="text" readonly="readonly" name="url" id="url" size="40"  >
					<input type="button" value="Select" class="upload_image" />
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>	
