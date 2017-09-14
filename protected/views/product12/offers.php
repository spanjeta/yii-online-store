<?php include(dirname(__FILE__).'/../user/tabs.php');?>

<div id="" class="offers_container tabs_inner">
  
 <hr>
 
 <div class="row-fluid">
 
 
<div class="span2">

<?php echo CHtml::link('Create New Offers',array('#'), array('class'=>'btn btn-primary span12')); ?>


</div>
<div class="span2">

<?php echo CHtml::link('Create New Deals',array('#'), array('class'=>'btn btn-primary span12')); ?>


</div>



 
 </div>
 
 
 <div class="clearfix"></div>
 
  <hr>
 
      <!---==============  offers & Deals Start ==============--> 

<div class="row-fluid offers_deals">

  <div class="span5 pull-left">

   <legend>List of Offers and Deals</legend>

   <table class="table">
  
              <tbody>
                <tr class="current">
				<td>Christmas Deals 50%</td>
                  <td>Active</td>
				    <td>
					    <button type="button" class="btn">Edit</button>
					    <button type="button" class="btn">Delete</button>
					  </td>               
                 
                </tr>
				
				
				<tr class="">
				<td>Christmas Deals 50%</td>
                  <td>Active</td>
				    <td>
					    <button type="button" class="btn">Edit</button>
					    <button type="button" class="btn">Delete</button>
					  </td>               
                 
                </tr>
				
				
				
				<tr class="">
				<td>Christmas Deals 50%</td>
                  <td>Active</td>
				    <td>
					    <button type="button" class="btn">Edit</button>
					    <button type="button" class="btn">Delete</button>
					  </td>               
                 
                </tr>
				
				
				
				<tr class="">
				<td>Christmas Deals 50%</td>
                  <td>Active</td>
				    <td>
					    <button type="button" class="btn">Edit</button>
					    <button type="button" class="btn">Delete</button>
					  </td>               
                 
                </tr>
				
				
				
                
              
              </tbody>
    </table>


   </div>





<div class="span7 pull-right">
<legend>List of Items</legend>

<?php $this->renderPartial('_plist', array('dataProvider'=> new CActiveDataProvider('Product'))); ?>

   </div>


<div class="clearfix"></div>

</div>


	   
        
</div>
<!---==============  offers & Deals END ==============--> 


