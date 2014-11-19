<?php
/**
 * voting plugin settings
 */

// set default value
if (!isset($vars['entity']->voting_option1)) {
	$vars['entity']->voting_option1 = 'no';
}

// set default value
if (!isset($vars['entity']->voting_option2)) {
	$vars['entity']->voting_option2 = 'no';
}

echo '<div>';
echo elgg_echo('voting:plugins:settings:explanation');
echo '</div><div>';
echo elgg_echo('voting:votingoption1');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[voting_option1]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->voting_option1,
));
echo '</div>';

echo '<div>';
echo elgg_echo('voting:votingoption2');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[voting_option2]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->voting_option2,
));
echo '</div>';
