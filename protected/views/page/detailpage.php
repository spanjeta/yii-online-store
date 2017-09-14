 <section class="privacy-policy">
             <div class="container">
              <div class="row">
               <div class="col-md-12">
                 <div class="policy-page-content">
                 <?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>
                   <br><h2 class="answer-title"><?php echo $model->title;?></h2>
                     <?php echo $model->content;?>

       </div>
       </div>
      </div>
     </div>
   </section>
 
  