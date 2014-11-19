<?php

// Get guids
$voting_guid = (int)get_input('voting_guid');
$user_guid = (int)get_input('user_guid'); 
$vote_option = get_input('vote_option');
$voting = get_entity($voting_guid);
$write = $voting->vote_access_id;
$num_choices = $voting->num_choices;
$options_choosen = count($vote_option);
$vote_access_id = $voting->vote_access_id;
$access_colection = get_access_array($user_guid);


	
if (!in_array($vote_access_id, $access_colection)) {
	register_error(elgg_echo('voting:error:not:permissions', array($options_choosen, $num_choices)));
	forward(REFERER);
}

if ($options_choosen > $num_choices) {
	
	register_error(elgg_echo('voting:error:toomany:optionchoosen', array($options_choosen, $num_choices)));
	forward(REFERER);
}



if (!$vote_option) {
	register_error(elgg_echo('voting:error:notvoted'));
	forward(REFERER);
} else {
	
	elgg_delete_annotations(array(
	//falta meter la entidad donde se esta borrando
		'guid' => $voting_guid,
		'annotation_name' => 'votes', 
		'annotation_owner_guid' => $user_guid,
		'limit' => 0,
		
	));
	
	
	if ($num_choices > 1) {
		foreach ($vote_option as $one) {
			$voting->annotate('votes', $one, $voting->access_id, $user_guid, '');
		}
	} else {
	$voting->annotate('votes', $vote_option, $voting->access_id, $user_guid, '');
	}
	
	$voting->save();	
	
}



