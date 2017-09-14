				<table width="50%">
					<tbody>
						<tr>
							<td colspan="">Total Content Node</td>
							<td><?php echo $allcontents;?></td>
						</tr>
						<tr>
							<td colspan="">Product</td>
							<td><?php echo $products?></td>
						</tr>
						<tr>
							<td colspan="">Emporium</td>
							<td><?php echo $emporiums?></td>

						</tr>

						<tr>
							<td colspan="">Blog</td>
							<td><?php echo $blogs?></td>

						</tr>

						<tr>
							<td colspan="">Deal</td>
							<td><?php echo $deals?></td>

						</tr>

						<tr>
							<td colspan="">Featured Item Total</td>
							<td><?php echo $featureitems?></td>

						</tr>
					</tbody>
				</table>


				<div class="span5 pull-right">

					<strong> Last Computed : </strong>
					 <?php 	if($computation) {?>
					<?php echo date('d/m/Y',strtotime($computation->computation_date)) ;?>
					<strong> Computation Time : <?php echo $computation->computation_time . ' '. 'Sec' ;?>
					</strong>
					<?php }?>
				</div>