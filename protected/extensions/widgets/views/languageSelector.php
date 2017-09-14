<?php /* echo CHtml::form(); ?>
<div id="language-select">
	<?php 
	if(sizeof($languages) < 4) {
		$lastElement = end($languages);
		foreach($languages as $key=>$lang) {
			if($key != $currentLang) {
				echo  '<b>'. CHtml::ajaxLink(CHtml::image(Yii::app()->request->baseUrl . '/images/' .$lang, $key,  array('title'=>$key == 'en'?'English':'Chinese')),'',
						array(
								'type'=>'post',
								'data'=>'_lang='.$key.'&YII_CSRF_TOKEN='.Yii::app()->request->csrfToken,
								'success' => 'function(data) {window.location.reload();}'
						),
						array()
				).'</b>';
			} else echo '<b>'.CHtml::image(Yii::app()->request->baseUrl . '/images/' .$lang, $key,  array('title'=> ($key == 'en')?'English':'chinese')).'</b>';
			if($lang != $lastElement) echo '  ';
		}
	}
	else {
		echo CHtml::dropDownList('_lang', $currentLang, $languages,
				array(
						'submit' => '',
						'csrf'=>true,
				)
		);
	}
	?>
</div>
<?php echo CHtml::endForm(); */?>


<?php echo CHtml::form(); ?>
<a data-toggle="dropdown" class="dropdown-toggle" href="#">
<?php

if($currentLang == 'en_us')
{
	$currentLang = 'en';
}
$lastElement = end ( $languages );

foreach ( $languages as $key => $lang ) {
	$language_name = User::getLanguageName ( $key );
	if ($key == $currentLang) {

		echo CHtml::image ( Yii::app ()->theme->baseUrl . '/images/' . $lang, $key, array (
				'title' => ($key == 'en') ? 'English' : 'Chinese' 
		) ) ;
	}
	
}
?>
									<i class="fa fa-angle-down"></i> 
</a>

<ul class="dropdown-menu">
	<?php
	if (sizeof ( $languages ) < 4) {
		
		$lastElement = end ( $languages );
		foreach ( $languages as $key => $lang ) {
			$language_name = User::getLanguageName ( $key );
			if ($key != $currentLang) {
				echo '<li id="language-select">' . CHtml::ajaxLink ( CHtml::image ( Yii::app ()->theme->baseUrl . '/images/' . $lang, $key, array (
						'title' => $key == 'en' ? 'English' : 'Chinese' 
				) ) .  $language_name, '', array (
						'type' => 'post',
						'data' => '_lang=' . $key . '&YII_CSRF_TOKEN=' . Yii::app ()->request->csrfToken,
						'success' => 'function(data) {window.location.reload();}' 
				), array () ) . '</li>';
			} else
				echo '<li> ' . CHtml::ajaxLink (CHtml::image ( Yii::app ()->theme->baseUrl . '/images/' . $lang, $key, array (
						'title' => ($key == 'en') ? 'English' : 'Chinese' 
				) ) .  $language_name, array () ). '</li>';
			if ($lang != $lastElement)
				echo '  ';
		}
	} else {
		echo CHtml::dropDownList ( '_lang', $currentLang, $languages, array (
				'submit' => '',
				'csrf' => true 
		) );
	}
	?>
	</ul>

<?php echo CHtml::endForm(); ?>