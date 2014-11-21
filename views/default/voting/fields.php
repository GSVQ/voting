<?php

$display_fields = $vars['views_options'];
$voting = $vars['entity'];

/*
 * 'information_link' => 'url',
		'num_choices' => 'text',
		'auditory' => 'text',
		'show_live_result' => 'text',
		'start_date' => 'date',
		'end_date' => 'date',
 * 
 * 
 */

echo '<ul class="voting-subtitle">';
	foreach ($display_fields as $name => $type) {
		if ($name == 'end_date' && !$voting->end_date) {
			echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
			echo elgg_view("output/$type", array('value' => elgg_echo('voting:manual:control'))) . '</li>';	
		} else if ($name == 'auditory'){
			if (!$voting->auditory) {
				echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
				echo elgg_view("output/$type", array('value' => elgg_echo('voting:no:auditory'))) . '</li>';
			} else {
				echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
				echo elgg_view("output/$type", array('value' => elgg_echo('voting:yes:auditory'))) . '</li>';
			}
		} else if ($name == 'show_live_result') {
			if (!$voting->show_live_result) {
				echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
				echo elgg_view("output/$type", array('value' => elgg_echo('voting:no:show_live_result'))) . '</li>';
			} else {
				echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
				echo elgg_view("output/$type", array('value' => elgg_echo('voting:yes:show_live_result'))) . '</li>';
			}
			
		} else if (!$voting->$name) {
		
		} else {
			echo '<li><b>' . elgg_echo("voting:label:$name") . ': </b>';
			echo elgg_view("output/$type", array('value' => $voting->$name)) . '</li>';	
		}	
	}
echo '</ul>';

