<div class="container">
<div class="panel widget">
	<div class="panel-heading vd_bg-yellow">
		<h3 class="panel-title">
			<span class="menu-icon"> <i class="icon-pie"></i>
			</span>
		</h3>

		<!-- vd_panel-menu -->

	</div>



	<div class="panel-body-list">

		<div class="form">


	
<?php
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
		'id' => 'comment-form',
		//'type' => 'horizontal',
		// 'enableAjaxValidation' => true,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>

<?php echo $form->errorSummary($comment); ?>

<?php
echo $form->html5EditorGroup ( $comment, 'comment', array (
		'class' => 'form-control',
		'rows' => 5,
		'height' => '50',
		/* 'options' => array (
				'color' => true
		) */
) );
//echo $form->textEditorGroup($comment,'comment', array('class'=>'form-control', 'rows'=>2 ));
?>
	

  
  
<?php
/* $this->widget ( 'CMultiFileUpload', array (
		'model' => $comment,
		'attribute' => 'files',
		// 'accept'=>'jpg|gif',
		'options' => array () 
) ); */
// 'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
// 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
// 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
// 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
// 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
// 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',

?>  
   
	<?php
	$this->widget ( 'booster.widgets.TbButton', array (
			'buttonType' => 'submit',
			'context' => 'success',
			'size' => '',
			'label' => 'Post Comment',
			'htmlOptions' => array (
					'class' => 'btn-sm pull-right post-comment' 
			) 
	) );
	
	?>

  

<?php $this->endWidget(); ?>

</div>
	
	</div>
</div>
</div>

		<!-- form -->
		
		<br>
		<br>
		<div class="container">
<div class="panel widget">
		
		
		<div class="content-list content-image menu-action-right">


			<ul class="list-wrapper">
						<?php
						$this->widget ( 'booster.widgets.TbListView', array (
								'dataProvider' => $dataProvider,
								'itemView' => '_view_comment',
						/* 		'sortableAttributes' => array (
										'create_user_id',
										'create_time' => 'Post Time' 
								)  */
						) );
						?>

			</ul>

		</div>
		</div>
		</div>
	