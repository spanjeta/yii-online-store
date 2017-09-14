<?php //include('tabuser.php');?>
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th,
	.table>thead>tr>td, .table>thead>tr>th {
	border-top: 0;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title no_margin clearfix"><?php echo Yii::t('app','profile')?></h3>
				</div>


				<div class="box-body clearfix">

					<div class="col-sm-2">
						<div class="profile-pic">
							<div style="height: auto; line-height: 84px; width: 100%;"
								data-trigger="fileinput" class="fileinput-preview thumbnail">
								<img alt="image" src="<?php echo $model->getImage();?>">
							</div>
						</div>
					</div>
					<div class="col-sm-10 padding_0">

						<div class="table-images-align">
							<table id="app-grid" class="detail-view table table-hover">
								<tbody>
									<tr class="even">
										<th><?php echo Yii::t('app','first name')?></th>
										<td><?php echo $model->first_name;?></td>
									</tr>
									<tr class="even">
										<th><?php echo Yii::t('app','last name')?></th>
										<td><?php echo $model->last_name;?></td>
									</tr>
									<tr class="even">
										<th><?php echo Yii::t('app','email address')?></th>
										<td><?php echo $model->email;?></td>
									</tr>
									<tr class="odd">
										<th><?php echo Yii::t('app','phone number')?></th>
										<td><?php echo $model->ph_no;?></td>
									</tr>
									<tr class="even">
										<th><?php echo Yii::t('app','create time')?></th>
										<td><?php echo $model->create_time;?></td>
									</tr>
								</tbody>
							</table>
						</div>

					</div>
				</div>
				
	<?php //$this->renderPartial('_myinfo',array('model'=>$model));?>
	</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){

$('#billing').click(function(){
	
	var url = "<?php echo Yii::app()->createUrl('company/billing')?>"
		$('#mydetail').load(url);

});
$('#usetting').click(function(){

	var url = "<?php echo Yii::app()->createUrl('company/setting')?>"
		$('#mydetail').load(url);
});
});

</script>
