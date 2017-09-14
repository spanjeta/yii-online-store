 <?php
						$this->widget ( 'zii.widgets.CListView', array (
								'dataProvider' => $dataProvider,
								'pager' => false,
								'emptyText' => '<i class="fa fa-frown-o"></i>  Sorry! No Product Found',
								'itemView' => '/product/_view',

								
								/* 'sortableAttributes' => array (
										//'id',
										//'title',
										//'create_time' 
								)  */
						) );
						?>