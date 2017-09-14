
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>


<div class="well"></div>

<div class="well">
<div class="row">
<h2>

Please Select option
</h2>
<a href ="#" id="showlogs" class="btn btn-warning">Show logs</a>


<a href ="#" id="deletassets" class="btn btn-warning">Delete Assets</a>


<a href ="#" id="deleteauth" class="btn btn-warning">Delete Auth Sessions</a>



</div>

<div class="span-16" id="data" style="min-height:200px;"></div>

</div>
<script>

    $("#showlogs").click(function(){
    
        	$.ajax({
				type : "POST",
				url : '<?php echo Yii::app()->createUrl('debugger/default/showlogs');  ?>',
				success: function(response) {
				    $("#data").html(response);
                   
				},
			error: function (request, error) {
				$("#data").html("<span style='color:red'>No Recent Logs</span>");
		    }
			});	

        });

    $("#deleteauth").click(function(){
        
    	$.ajax({
			type : "POST",
			url : '<?php echo Yii::app()->createUrl('debugger/default/deleteAuthsessions');  ?>',
			success: function(response) {
			    $("#data").html(response);
               
			},
			error: function (request, error) {
				$("#data").html("<span style='color:red'>Not done</span>");
		    }
			
		});	

    });

    $("#deletassets").click(function(){
        
    	$.ajax({
			type : "POST",
			url : '<?php echo Yii::app()->createUrl('debugger/default/deleteAssets');  ?>',
			success: function(response) {
			    $("#data").html(response);
               
			},
			error: function (request, error) {
				$("#data").html("<span style='color:red'>Not done</span>");
		    }
			
		});	

    });


</script>
