<section class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">

		<?php 
		$translate=Yii::app()->translate;
		$lang = $translate->getLanguage();
		//print_r($lang);exit;
		$data = Page::model()->findByAttributes(array(
				'type_id' => Page::TYPE_ABOUT_US,
				'lang_type' => $lang
		));?>
		<?php if(!empty($data)){?>
			<h3><?php echo $data->title ?></h3>
		<hr>
		
			<?php 
				$p = new CHtmlPurifier();
				$content = trim($p->processOutput($data->content));
				echo "".$content;
			?>
		<?php }else{?>
				<?php echo "No Page Contents"; ?>
		<?php }?>
	</div>
</div>
</div>
</div>
</section>




