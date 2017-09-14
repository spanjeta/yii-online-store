<div class="row-fluid advance_search">


	<div class="pull-left">

		<div class="span4">
		<?php
		$model->category_id = $id;
		
		echo CHtml::dropDownList('category_id',$model->category_id,CHtml::listData(Category::model()->findAll(),'id','title'),
		array('empty'=>'Select Category','onChange'=>"searchfun(' " .Home::SEARCH_CAT." ' )"));
		?>
		</div>

		<div class="span2">
		<?php
		echo CHtml::dropDownList('store_id',$model,CHtml::listData(Company::model()->findAll(),'id','shop_name'),
		array('empty' => 'Store','onChange'=>"searchfun(' " .Home::SEARCH_STORE." ' )"));

		?>
		</div>

		<div class="span2">
		<?php
		echo CHtml::dropDownList('brand_id',$model,CHtml::listData(Brand::model()->findAll(),'id','title'),
		array('empty' => 'Brand','onChange'=>"searchfun(' " .Home::SEARCH_BRAND." ' )"));
		?>
		</div>
		<div class="span2">
		<?php
		echo CHtml::dropDownList('color_id',$model,CHtml::listData(Color::model()->findAll(),'id','title'),
		array('empty' => 'Color','onChange'=>"searchfun(' " .Home::SEARCH_COLOR." ' )"));

		?>
		</div>

		<div class="span2">
			<p class="is_sale">
				<input type="checkbox" name="is_sale" id="on_sale"
					onClick="searchfun(10)"> On Sale
			</p>
			<br>
		</div>
		<!--  here is category dropdown list -->
	</div>

	<div class="pull-right">

		<div class="right_search">
		<?php
		echo CHtml::dropDownList('price',$model,array('Featured','Price high to low','Price Low to high','Most viewed'),
		array('onChange'=>"searchfun(' " .Home::SEARCH_PRICE." ' )"));

		?>
		</div>

	</div>

	<div class="clearfix"></div>
	<div class="row-fluid">
		<hr>
		<div id="hide_clear">
			<div id="sel_cat" class="pull-left"></div>
			<div id="sel_store" class="pull-left"></div>
			<div id="sel_brand" class="pull-left"></div>
			<div id="sel_color" class="pull-left"></div>
			<div id="clear_all" class="pull-left" style="display: none">
			<?php echo CHtml::link('ClearAll',array('site/category'),array('class'=>'btn'));?>
			</div>
		</div>

	</div>

</div>
<script type="text/javascript">

// this is using first time when showing the selected category.

$(document).ready(function(){

	var category_id = $("#category_id option:selected").val();
	var category_text = $("#category_id option:selected").text();
	var type = 1;
	
	if(category_id)
	{
	var button = '<button type="button" class="btn" onclick="removeSelected('+type+')" > '+category_text+' <i class="fa fa-times-circle"></i></button>';
	$('#sel_cat').html(button);
	}
	else
	{
		$('#sel_cat').html('');
	}
});


	function searchfun(id)
	{
	
		if(id < 6)
		{
		sendList(id)  //  for dynamic list we userd it
		}
				var category_id = $("#category_id option:selected").val();
		
				var store_id = $("#store_id option:selected").val();
		
				var brand_id = $("#brand_id option:selected").val();
	
				var color_id = $("#color_id option:selected").val();

				var price_id =  $("#price option:selected").val();

				var is_discount = $("#on_sale").attr("checked") ? <?php echo Product::SALE_ON?> : <?php echo Product::SALE_OFF?>;

				if(category_id || store_id || brand_id || color_id )
				$('#clear_all').show();
						else $('#clear_all').hide();
				
						$.ajax({
					type: "POST",
					data: {category_id:category_id,store_id:store_id,brand_id:brand_id,
						color_id:color_id,price_id:price_id,is_discount:is_discount},
						
					url: "<?php echo Yii::app()->createUrl('site/Search')?>",
					success: function(data, response){
						if(response == 'success')
						{
							//
							//	data = myrun(data);
							$("#cat_data").html(data);
							//myrun();
						}
					},
					complete: function(){
					
						 $('img').load(function(){
					            $(".brick-header").masonry();
					            $('#masonry').masonry('reloadItems').masonry();
					        });
					        $(".brick-header").masonry();
						}
						});
		 }

function sendList(id)
{
	var type = parseInt(id);

	switch (type) 
	{
	case 1 : 
	var category_id = $("#category_id option:selected").val();
	var category_text = $("#category_id option:selected").text();

	if(category_id)
	{
	var button = '<button type="button" class="btn" onclick="removeSelected('+type+')" > '+category_text+' <i class="fa fa-times-circle"></i></button>';
	$('#sel_cat').html(button);
	}
	else
	{
		$('#sel_cat').html('');
	}
	 break;
case 2 : 
	var store_id = $("#store_id option:selected").val();
	var store_text = $("#store_id option:selected").text();

	if(store_id)
	{
	var button = '<button type="button" class="btn" onclick="removeSelected('+type+')" > '+store_text+' <i class="fa fa-times-circle"></i></button>';
	$('#sel_store').html(button);
	}
	else
	{
		$('#sel_store').html('');
	}
	break;

case 3 : 
	var brand_id = $("#brand_id option:selected").val();
	var brand_text = $("#brand_id option:selected").text();
	if(brand_id)
	{
	var button = '<button type="button" class="btn" onclick="removeSelected('+type+')" > '+brand_text+' <i class="fa fa-times-circle"></i></button>';
	$('#sel_brand').html(button);
	}
	else
	{
		$('#sel_brand').html('');
	}
	break;

case 4 : 
	var color_id = $("#color_id option:selected").val();

	if(color_id)
	{
	var color_text = $("#color_id option:selected").text();
	var button = '<button type="button" class="btn" onclick="removeSelected('+type+')" > '+color_text+' <i class="fa fa-times-circle"></i></button>';
	$('#sel_color').html(button);

	}
	else
	{
		$('#sel_color').html('');
	}
	break;
}
	
}

function removeSelected(type)
{
switch (type) 
	{
case 1 : 
	$('#category_id').val('');
	$('#sel_cat').html('');
	searchfun(10);
	 break;
case 2 : 
	 $("#store_id").val('');
	$('#sel_store').html('');
	searchfun(10);
	break;

case 3 : 
	$("#brand_id").val('');
	$('#sel_brand').html('');
	searchfun(10);
	break;

case 4 : 
	$("#color_id").val('');
	$('#sel_color').html('');
	searchfun(10);
	break;''
}

}
			</script>
