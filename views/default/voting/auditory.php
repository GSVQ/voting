<?php
$voting = $vars['entity'];

echo '<br><h3>' . elgg_echo('auditory:auditory') . '</h3>';
echo elgg_list_annotations(array(
	'guid' => $voting->guid,
	'annotation_name' => 'votes', 
	//'annotation_owner_guid' => $user_guid,
	'limit' => 10,
	));
