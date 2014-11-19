<?php

elgg_load_library('skeletor:voting');
$voting = elgg_extract('entity', $vars);
$options = elgg_extract('options', $vars);
$n_options = elgg_extract('n_options', $vars);
$user_guid = elgg_get_logged_in_user_guid();
$voted_option = voting_user_option_voted($voting->guid, $user_guid);
$num_choices =  elgg_extract('num_choices', $vars);

foreach ($options as $option_field_n => $option) {
	$op = elgg_echo($option);
	$radio[$op] = $option_field_n;
	
}
 

$rand_radio = shuffle_assoc($radio);

if ($num_choices == 1) {
echo "<br/><br/><div><label>";
echo elgg_echo("voting:vote:an:option");
echo "</label></div>";

echo "<div>"; 


	echo elgg_view('input/radio',array(
		'name'=>'vote_option',
		'value'=>$voted_option,
		'options'=>$rand_radio, 
		'class' => 'voting-options-fields',
		));
	
	echo "</div>";
} else {
	echo "<br/><br/><div><label>";
	echo elgg_echo("voting:vote:n:options", array($num_choices));
	echo "</label></div>";
	
	echo "<div>"; 
	
	
		echo elgg_view('input/checkboxes',array(
			'name'=>'vote_option',
			'value'=>$voted_option,
			'options'=>$rand_radio, 
			'class' => 'voting-options-fields',
			));
		
		echo "</div>";
	
}

echo '<div class="elgg-foot">';


echo elgg_view('input/hidden', array(
		'name' => 'voting_guid',
		'value' => $voting->guid,
	));

echo elgg_view('input/hidden', array(
	'name' => 'user_guid',
	'value' => $user_guid,
));



echo elgg_view('input/submit', array('value' => elgg_echo('vote')));

echo '</div>';
	
	
