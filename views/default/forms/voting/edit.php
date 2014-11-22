<?php
/** 
 * voting/views/default/forms/voting/edit.php
 * 
 * voting new form body
 *
 * @package voting
 */
$variables = elgg_get_config('voting');
$user = elgg_get_logged_in_user_entity();
$entity = elgg_extract('entity', $vars);
//print_r($entity);
if ($entity) {
	 $options_n = $entity->options_n;
	 for ($i=0; $i < $options_n; $i++) {
		 $request = 'options_field_' . $i;
		 $array_options[$request] = $entity->$request;
	 }
}

$can_change_access = true;
if ($user && $entity) {
	$can_change_access = ($user->isAdmin() || $user->getGUID() == $entity->owner_guid);
}

foreach ($variables as $name => $type) {
	// don't show read / write access inputs for non-owners or admin when editing
	if (($type == 'access' || $type == 'write_access') && !$can_change_access) {
		continue;
	}
	echo '<br/>';
	$input_view = "input/$type";
	switch ($type) {
		case 'auto_add_text':
			
			?>
			<div>		
			<?php	
				echo elgg_view($input_view, array(
					'name' => $name,
					'value' => $vars[$name],
					'entity' => $entity,
					'options_n' => $options_n,
					'array_options' => $array_options,
				));
			?>
			</div>
			<?php
			break;
		case 'checkbox':
			?>
			<div>
				<?php
					if (!$vars[$name]) {
						
						$checked = false;
					} else {
						$checked = 'checked';
					}	
						
					echo elgg_view($input_view, array(
						'name' => $name,
						'checked' => $checked,
					));
					
				?>
				<label><?php echo elgg_echo("voting:$name"); ?></label>
				
				
			</div>
			<?php
			break;
		case 'integer':
			?>
			<div>
				
				<label><?php echo elgg_echo("voting:$name"); ?></label>	
				<?php
					
					echo elgg_view($input_view, array(
						'name' => $name,
						'value' => $vars[$name],
						'min' => 1,
						//'max' => 10
					));
				?>

				
			</div>
			<?php
			break;
		case 'dropdown':
			?>
			<div>
				
				<label><?php echo elgg_echo("voting:$name");  ?></label>	
				<?php
					
					echo elgg_view($input_view, array(
						'name' => $name,
						'value' => $vars[$name],
						'options_values' => array(
							'normal' => elgg_echo('voting:type:normal'),
							'condorcet' => elgg_echo('voting:type:condorcet'),
						),
					));
				?>

				
			</div>
			<?php
			break;
			
			
		default:
			?>
			<div>
				<label><?php echo elgg_echo("voting:$name") ?></label>
				<?php
					if ($type != 'longtext') {
						echo '<br />';
					}
			
					echo elgg_view($input_view, array(
						'name' => $name,
						'value' => $vars[$name],
					));
				?>
			</div>
			<?php
		}
	}
			

$cats = elgg_view('input/categories', $vars);
if (!empty($cats)) {
	echo $cats;
}

echo '<br/>';
echo '<div class="elgg-foot">';
if ($vars['guid']) {
	echo elgg_view('input/hidden', array(
		'name' => 'voting_guid',
		'value' => $vars['guid'],
	));
}
echo elgg_view('input/hidden', array(
	'name' => 'container_guid',
	'value' => $vars['container_guid'],
));

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

echo '</div>';
