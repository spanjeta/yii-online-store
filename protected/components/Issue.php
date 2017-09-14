<?php
class Issue extends CWidget
{

	/* 	public function run()
	 {
	echo 'in run';

	$this->render('issue');

	echo $this->id;
	} */
	public function init()
	{
		$this->render('issue',array());
	}
}