
<table width="50%">
	<tbody>
		<tr>
			<td colspan="">Total User</td>
			<td><?php echo $allusers;?></td>
		</tr>
		<tr>
			<td colspan="">Basic User</td>
			<td><?php echo $basicusers?></td>
		</tr>
		<tr>
			<td colspan="">Business User</td>
			<td><?php echo $bususers?></td>

		</tr>

		<tr>
			<td colspan="">User Joined (new user)</td>
			<td><?php echo $newusers?></td>

		</tr>

	</tbody>
</table>


<div class="span5 pull-right">

	<strong> Last Computed : </strong>
 <?php 	if($computation) {?>
 	<?php echo date( 'd/m/Y',strtotime($computation->computation_date)) ;?>
	<strong> Computation Time : <?php echo $computation->computation_time . ' '. 'Sec' ;?>
	</strong>
	<?php }?>
</div>
