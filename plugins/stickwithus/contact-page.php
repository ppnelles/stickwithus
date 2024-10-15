<?php
	global $wpdb;
	$messages = $wpdb->get_results( "SELECT * FROM `sw_entry` ORDER BY `sw_entry`.`id` ASC" );
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo count($messages); ?> Messages(s)</h1>

	<table class="wp-list-table widefat fixed striped table-view-list pages">
		<thead>
			<tr>
				<th>#</th>
				<th>Prénom</th>
				<th>Nom</th>
				<th>Email</th>
				<th>GSM</th>
				<th>Type</th>
				<th>Formule choisie</th>
				<th>Nom du sponsor</th>
				<th>Secteur d'activités</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; foreach($messages as $msg) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $msg->firstname ?></td>
					<td><?php echo $msg->lastname ?></td>
					<td><?php echo $msg->email ?></td>
					<td><?php echo $msg->phone ?></td>
					<td><?php echo $msg->contact_type ?></td>
					<td><?php echo $msg->selected_formula ?></td>
					<td><?php echo $msg->company_name ?></td>
					<td><?php echo $msg->company_activity ?></td>
				</tr>
			<?php $i++; } ?>
		</tbody>
	</table>

</div>