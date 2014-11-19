<?php

elgg_load_library('skeletor:voting');
$voting = elgg_extract('entity', $vars);
$options = elgg_extract('options', $vars);
$n_options = elgg_extract('n_options', $vars);
$user_guid = elgg_get_logged_in_user_guid();
$voted_option = voting_user_option_voted($voting->guid, $user_guid);
$num_choices =  elgg_extract('num_choices', $vars);
$vote_access_id = $voting->vote_access_id;
$access_colection = get_access_array($user_guid);


	
if (!in_array($vote_access_id, $access_colection)) {
	echo "<br/><br/><div  class='not-access-voting'><label>";
	echo elgg_echo("voting:vote:n:options:not:access");
	echo "</label></div>";
}

echo "<br/><br/><div><label>";
echo elgg_echo("voting:vote:n:options:notstarted", array($num_choices));

echo "</label></div>";
echo '<ul class="voting-options-fields">';
foreach ($options as $option_field_n => $option) {
	echo '<li>' . $option . '</li>';
	
}

echo '</ul>';

	
	
