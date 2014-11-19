<?php

$guid = get_input('guid');

$voting = get_entity($guid);

//$now = date('Y-m-d', time());

if (guid) {
	$voting = get_entity($guid);
	if (!$voting || !$voting->canEdit()) {
		register_error(elgg_echo('voting:error:no_save'));
		forward(REFERER);
	} else {
		$voting->closed = true;
		//$voting->end_date=$now;
	}
}
	if ($voting->save()) {

	//elgg_clear_sticky_form('voting');

	// Now save description as an annotation
	//$voting->annotate('voting', $voting->description, $voting->access_id);

	system_message(elgg_echo('voting:closed'));

	forward($voting->getURL());
} else {
	register_error(elgg_echo('voting:error:notsaved'));
	forward(REFERER);
}
