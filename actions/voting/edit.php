<?php
/**
 * voting/actions/voting/edit.php
 * 
 * Save voting entity
 *
 * @package voting
 */

$variables = elgg_get_config('voting');
elgg_load_library('aruberuto:aat');
$input = array();
foreach ($variables as $name => $type) {
	if ($name == 'title') {
		$input[$name] = htmlspecialchars(get_input($name, '', false), ENT_QUOTES, 'UTF-8');
	} else	if ($type == 'auto_add_text') {
		$fields = aat_get_not_empty_fields_from_form($name);		
		$n_fields = aat_get_not_empty_n_fields_from_form($name);
		$input[$name . '_n'] = $n_fields;
		foreach ($fields as $num => $field) {
			$input[$name . '_field_' . $num] = $field;
		}
		
	}else if ($name == 'start_date') {
		$input[$name] = get_input($name);
		if (!$input[$name]) {
			$input[$name] = date('Y-m-d', time());
		}
	
	} 
	else {
		$input[$name] = get_input($name);
	}
	if ($type == 'tags') {
		$input[$name] = string_to_tag_array($input[$name]);
	}
	
}
system_message(print_r($input));
// Get guids
$voting_guid = (int)get_input('voting_guid');
$container_guid = (int)get_input('container_guid'); 


elgg_make_sticky_form('voting');

if (!$input['title']) {
	register_error(elgg_echo('voting:error:no_title'));
	forward(REFERER);
}

if ($input['options_n'] == 0) {
	register_error(elgg_echo('voting:error:no_options'));
	forward(REFERER);
}

if ($input['end_date'] && strtotime($input['start_date']) >= strtotime($input['end_date'])) {
	register_error(elgg_echo('voting:error:date:imposible'));
	forward(REFERER);
}
if ($input['num_choices'] > $input['options_n']) {
	register_error(elgg_echo('voting:error:num_choices:imposible'));
	forward(REFERER);
	
}
if ($input['information_link'] == 'http://' || $input['information_link'] == 'https://') {
	$input['information_link'] = '';
	
}



if ($voting_guid) {
	$voting = get_entity($voting_guid);
	if (!$voting || !$voting->canEdit()) {
		register_error(elgg_echo('voting:error:no_save'));
		forward(REFERER);
	}
	$new_voting = false;
} else {
	$voting = new ElggObject();
	$voting->subtype = 'voting';
	$new_voting = true;
}

if (sizeof($input) > 0) {
	// don't change access if not an owner/admin
	$user = elgg_get_logged_in_user_entity();
	$can_change_access = true;

	if ($user && $voting) {
		$can_change_access = $user->isAdmin() || $user->getGUID() == $voting->owner_guid;
	}
	
	foreach ($input as $name => $value) {
		if (($name == 'access_id' || $name == 'write_access_id') && !$can_change_access) {
			continue;
		}
	$msg .= 'voting->' . "$name" . '=' . "$value <br><br>";	
	$voting->$name = $value;
	}
}
//system_message($msg);
// need to add check to make sure user can write to container
$voting->container_guid = $container_guid;

if ($voting->save()) {

	elgg_clear_sticky_form('voting');

	// Now save description as an annotation
	$voting->annotate('voting', $voting->description, $voting->access_id);

	system_message(elgg_echo('voting:saved'));

	if ($new_voting) {
		add_to_river('river/object/voting/create', 'create', elgg_get_logged_in_user_guid(), $voting->guid);
	}

	forward($voting->getURL());
} else {
	register_error(elgg_echo('voting:error:notsaved'));
	forward(REFERER);
}


