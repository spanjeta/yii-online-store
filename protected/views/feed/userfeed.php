<div class="vd_content-section clearfix">
<div class="row">
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<div class="tabs widget">
				<ul class="nav nav-tabs widget">
					<li class="active"><a href="#home-tab" data-toggle="tab"> <span
							class="menu-icon"><i class="fa fa-comments"></i></span> Feeds
							 <span class="menu-active"><i class="fa fa-caret-up"></i></span>
					</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home-tab">
						<div class="content-list content-image menu-action-right">
					
									<div style="position: relative; top: 0px;"
										class="mCSB_container">

<ul class="list-wrapper pd-lr-15">
<?php
$this->widget('booster.widgets.TbListView', array(
    'dataProvider'=> $dataProvider,
    'itemView'=>'_view',   // refers to the partial view named '_view'
    'sortableAttributes'=>array(
        'id',
        'title',
        'create_time',
    ),
));?>
</ul>

</div>
									
								</div>
						

					</div>
				</div>
			</div>
			<!-- tabs-widget -->
		</div>
		<!-- col-md-12 -->
	</div>
	<!-- row -->
</div></div></div>
