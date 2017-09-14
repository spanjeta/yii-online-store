<?php


class ActiveForm extends CActiveForm {


	public function checkBoxList($model, $attribute, $data, $htmlOptions = array()) {
		return Html::activeCheckBoxList($model, $attribute, $data, $htmlOptions);
	}

}