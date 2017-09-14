
<?php include(dirname(__FILE__).'/../user/tabs.php')?>

<div class="tabs_inner">
	<div id="home" class="tab-pane active">

<h4>
	<strong>Tips:</strong> To change shop name, logo, social media links,
	and contact details please go to <a href="#">shop detail page</a>
</h4>

<div class="clearfix"></div>

<div class="row-fluid">
	<div class="span2">
		<h4>Shop Slogan</h4>
	</div>

	<div class="span5">

		<input type="text" name="slogan" class='slogan_field row-fluid'
			id="s_slo"
			value="<?php echo Yii::app()->user->model->company->shop_slogan;?>">
	</div>

</div>

<hr>
<div class="row-fluid ">

	<h4>Slide Show</h4>

	<?php echo CHtml::link('Add New Slide','',array('class'=>'btn','id'=>'adslide'));?>


	<div class="clearfix mar_top2"></div>

	<div id="sld_form" style="display: none;" class="offset3">
		<?php $this->renderPartial('_sliderform',array('model'=>new SliderImage()),false,true)?>
	</div>

	<!-- slider images -->
	<div class="row-fluid add_slide" id="sld_list" style="display: none"></div>

	<hr>

	<div class=" content_slogan">
		<h4>Featured Post On My Home Page</h4>

		<p>
			Following are the post(products , emporium, blogs) that
			marked("Featured" You can use the cursor to arrange the order of </br>
			these featured posts that appear on your home page.)
		</p>

	</div>
	<hr>
	<div class="clearfix mar_top2"></div>
	<?php 
	$sortableItems1  = array();
	foreach($homes as $home)
	{
		$sortableItems1[$home->id] = '<div class="row-fluid ui-state-default"> <p class="move_icon"><i class="fa fa-arrows"></i></p> <div class="span2"> <p>'
			.$home->getName(). '</p></div>'.'<div class="span2"><p>'.$home->model_type.'</p></div>'.
			'<div class="span2"><p>'.$home->formatDateTime($home->create_time).'</p></div>'.'<div class="span2"><p>'.
			'<a class="cursor" onclick="deleteBlog('.$home->id.')"> <i  class="fa fa-times-circle" ></i> </a>'.'</p></div>'.'</div>';
	}
	?>
	<table class="slide_table">

		<th class="">Name</th>
		<th class="">Type</th>
		<th class="">Date Modified</th>

	</table>

	<div class="slide_list">
		<?php 
		$this->widget('zii.widgets.jui.CJuiSortable',array(
	'id'=>'blog_shortable',
    'items'=> $sortableItems1,
 //  'itemTemplate'=>'<li id="{id}" class="ui-state-default"><span class="ui-icon ui-icon-delete"></span>{content}'.$delete1.'</li>',

    // additional javascript options for the JUI Sortable plugin
    'options'=>array(
        'delay'=>'300',
    ),
));
?>

	</div>

	<hr>

	<div class="">

		<?php echo CHtml::link('Save','#',array('class'=>'btn btn-primary','id'=>'slist'));?>

	</div>
</div>

</div>

</div>
<script>

	function deleteSlider(id)
	{

		  var x = confirm("Are you sure you want to delete?");
		  if (x)
		  {
	$.ajax({

		url: "<?php echo Yii::app()->createUrl('sliderImage/deleteAjax/id')?>/"+id,
	
		}) .done(function( msg ) {
	if(msg == 'success')
	{
		$('#abc_'+id).remove();		

	}
	
		});
		}
	}

	function deleteBlog(id)
	{

		  var x = confirm("Are you sure you want to delete?");
		  if (x)
		  {
	$.ajax({

		url: "<?php echo Yii::app()->createUrl('home/deleteAjax/id')?>/"+id,
	
		}) .done(function( msg ) {
	if(msg == 'success')
	{
		$('#'+id).remove();		
	
	}
	
		});
		}
	}
	
	</script>

<script>

$(document).ready(function() {

$('#slist').click(function(){

	var images = $('#short').find('li').map(function() {
		    return (this.id);
		}).get();

	var posts = $('#blog_shortable').find('li').map(function() {
	    return (this.id);
	}).get();
		
var	slogan = document.getElementById('s_slo').value;
//	alert(images);
//	alert(posts);
//	alert(slogan);


$.ajax({
    type: "POST",
    data: {images:images,posts:posts,slogan:slogan},
	url: "<?php echo Yii::app()->createUrl('sliderImage/ajaxUpdate')?>",
        success: function(msg)
        {
        	window.location.href = '<?php echo Yii::app()->createUrl('user/view');?>';
               // some suff there
        }
    });
				});

$('#adslide').click(function(){
$('#sld_list').hide();
$('#sld_form').show();
	
});


});
</script>

	<script>
$(document).ready(function() { 

	$('#pmanage').click( function(){

		var url = "<?php echo Yii::app()->createUrl('sliderImage/ajaxIndex');?>";	
		$('#sld_list').load(url,function(data,response) {
				if(response == 'success')
			$('#sld_list').show(1000);
			});
		});

});


</script>