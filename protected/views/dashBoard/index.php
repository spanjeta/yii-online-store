<?php include(dirname(__FILE__).'/../user/tabs.php');?>

<div class="tabs_inner">

	<div class="buttons_group">
		<?php
		$this->widget('booster.widgets.TbMenu', array(
				//'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				//	'size'=>'large',

				'buttons'=>array(
						array('label'=>'Generate Report', 'url'=>'#'),
						array('items'=>array(
								array('label'=>'Option1', 'url'=>Yii::app()->createUrl('#',array('by'=>1))),
								'---',
								array('label'=>'Option2', 'url'=>Yii::app()->createUrl('#',array('by'=>2))),
								'---',
								array('label'=>'Option3', 'url'=>Yii::app()->createUrl('#',array('by'=>3))),
								'---',
								array('label'=>'Option4', 'url'=>Yii::app()->createUrl('#',array('by'=>4))),
								'---',
								//	array('label'=>'DeadLine Ending Last', 'url'=>'#'),
						)),
				),
				//'htmlOptions'=>array('class'=>'pull-right SortMostRecent'),
		));

		echo  CHtml::link('Execute',array('#'),array('class'=>'btn btn-rounded'));

		?>

	</div>
	<hr>


	<div class="row-fluid">



			<div class="span6 pull-left">

				<table class="table table-hover table-striped  table-bordered">
					<thead>
						<tr>
							<th colspan="2"><span class="pull-left">To do List</span> <input
								type="text" placeholder="Edit" class="pull-right">
							</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>1</td>


						</tr>
						<tr>
							<td>Jacob</td>
							<td>2</td>


						</tr>
						<tr>
							<td>Larry</td>
							<td>3</td>


						</tr>
					</tbody>
				</table>


			</div>





			<div class="span6 pull-right">

				<table class="table table-hover table-striped  table-bordered">
					<thead>
						<tr>
							<th colspan="2"><span class="pull-left">Orders</span> <input
								type="text" placeholder="Edit" class="pull-right">
							</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>1</td>


						</tr>
						<tr>
							<td>Jacob</td>
							<td>2</td>


						</tr>
						<tr>
							<td>Larry</td>
							<td>3</td>


						</tr>
					</tbody>
				</table>


			</div>



			<div class="clearfix"></div>

		</div>


		<div class="row-fluid">



			<div class="span6 pull-left">

				<table class="table table-hover table-striped  table-bordered">
					<thead>
						<tr>
							<th colspan="2"><span class="pull-left">To do List</span> <input
								type="text" placeholder="Edit" class="pull-right">
							</th>


						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>1</td>


						</tr>
						<tr>
							<td>Jacob</td>
							<td>2</td>


						</tr>
						<tr>
							<td>Larry</td>
							<td>3</td>


						</tr>
					</tbody>
				</table>


			</div>





			<div class="span6 pull-right">

				<table class="table table-hover table-striped  table-bordered">
					<thead>
						<tr>
							<th colspan="2"><span class="pull-left">Orders</span> <input
								type="text" placeholder="Edit" class="pull-right">
							</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Mark</td>
							<td>1</td>


						</tr>
						<tr>
							<td>Jacob</td>
							<td>2</td>


						</tr>
						<tr>
							<td>Larry</td>
							<td>3</td>


						</tr>
					</tbody>
				</table>


			</div>



			<div class="clearfix"></div>

		</div>
	