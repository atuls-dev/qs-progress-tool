<?php
global $qs_smoking;
$achievement = $qs_smoking->qs_achievements('cigarette');
?>

<div class="wrap">
	<h2>Cigarette Achievement</h2>
	<div class="content_wrapper">
		<div class="left">
			<table class="achievement_table display hover stripe">
			    <thead>
			        <tr>
			        	<th>Sr. No</th>
			            <th>Achievement</th>
			            <th>Name</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php
			    		$i = 1;
			    		foreach ($achievement as $key => $value) {
			    			echo '<tr>';
			    				echo "<td>".$i."</td>";
			    				echo "<td><img id='full_ach_".$value['id']."' src='".$value['image']."' width='50px'></td>";
			    				echo "<td>".$value['name']."</td>";
			    				echo "<td>";
			    				 add_thickbox();
									?><div id="my-content-<?php echo $value['id']?>" style="display:none;">
									     <p>
									     	<form class="achievement_form qs-esi-shadow">
									     	  <table class="form-table" role="presentation">
									     	  	<tbody>
									     	  		<tr>
									     	  			<th scope="row"><img id="preview_image_<?php echo $value['id']?>" src='<?php echo $value['image'] ?>' width='200px'></th>
									     	  			<td><input id="upload_image_<?php echo $value['id']?>" type="hidden" size="36" name="upload_image" value="<?php echo $value['image'] ?>"/>
									          				<input type="hidden" name="id" value="<?php echo $value['id']?>"/>
									          				<input class="upload_image_button button button-primary" ach_id="<?php echo $value['id']?>" type="button" value="Change Achievement" />
									          				<input type="hidden" name="action" value="qs_update_achievement"/>
														</td>
													</tr>
													</tbody>
											  </table>


									          <input type="submit" name="submit" value="save" class="button button-primary">
									        </form>
									     </p>
									</div>

									<a href="#TB_inline?&width=500&height=500&inlineId=my-content-<?php echo $value['id']?>" class="thickbox">Edit</a>
									<?php
			    			echo '</td></tr>';
			    		$i++;
			    		}
			    	?>
			    </tbody>
			    <tfoot>
			        <tr>
			        	<th>Sr. No</th>
			            <th>Achievement</th>
			            <th>Name</th>
			            <th>Action</th>
			        </tr>
			    </tfoot>
			</table>
		</div>
	</div>
<div>