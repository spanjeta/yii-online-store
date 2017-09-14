
<?php

if($sliderimages)
{
	foreach ($sliderimages as $sliderimage)
	{
		$sortableItems['abc_'.$sliderimage->id] =


		'<a class="cursor" onclick="deleteSlider('.$sliderimage->id.')"> <i  class="fa fa-times-circle" ></i> </a>'.
		CHtml::image(Yii::app()->createUrl('sliderImage/thumb',array('file'=>$sliderimage->slider_image,'id'=>$sliderimage->create_user_id)),'alter',array('class'=>'listimage'));
		//			$delete = '<a class="cursor" onclick="deleteSlider({id})"> <i  class="fa fa-times-circle" ></i> </a>';
	}

	$this->widget('zii.widgets.jui.CJuiSortable',array(
			'id'=>'short',
			'items'=> $sortableItems,
			//	'itemTemplate'=>'<li id="abc_{id}" class="ui-state-default">{content}'.$delete.'</li>',
			// additional javascript options for the JUI Sortable plugin
			'options'=>array(
					'delay'=>'300',
			),
	));
}

else
{
	echo '<h3> Add slider image here </h3>';
}

