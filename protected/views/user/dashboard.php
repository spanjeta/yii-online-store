<?php include('tabs.php');?>

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


	<?php $this->renderPartial('_busdash',array('model' => $model,
			'sliderimages'=>$sliderimages,
					'homes'=>$homes))?>