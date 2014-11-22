<?php
/**
 * The core language file is in /languages/en.php and each plugin has its
 * language files in a languages directory. To change a string, copy the
 * mapping into this file.
 *
 * For example, to change the blog Tools menu item
 * from \"Blog\" to \"Rantings\", copy this pair:
 * 			'blog' => \"Blog\",
 * into the $mapping array so that it looks like:
 * 			'blog' => \"Rantings\",
 *
 * Follow this pattern for any other string you want to change. Make sure this
 * plugin is lower in the plugin list than any plugin that it is modifying.
 *
 * If you want to add languages other than English, name the file according to
 * the language's ISO 639-1 code: http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
 */

$mapping = array(
	'voting:menu' => 'voting',
	'voting:none' => 'No voting',
	'voting:add' => 'Add a new voting',
	'voting' => 'voting',
	'voting:all' => 'All voting',
	'voting:title' => 'voting title',
	'voting:description' => 'voting text',
	'voting:tags' => 'Tags',
	'voting:access_id' => 'Read access',
	'voting:write_access_id' => 'Write access',
	'item:object:voting' => 'voting',
	'voting:edit' => 'Edit %s',
	'voting:legend:result' => 'Results:',
	'voting:legend:total:votes' => 'total votes',
	'voting:legend:voting:of' => 'votes of',
	"voting:vote:n:options" => 'Choose %s options',
	'voting:error:toomany:optionchoosen' => 'Vote Error: You have choose %s options and the limit is %s',
	'voting:error:thereis:votes' => 'You can\'t edit votation: Alredy has votes',
	'voting:information_link' => 'Link to explanation',
	'voting:num_choices' => 'Maximun choices to vote',
	'voting:auditory' => 'Auditory',
	'voting:show_live_result' => 'Show result before end voting',
	'voting:start_date' => 'Start date for voting (leave it blank to take "now" date)',
	'voting:end_date' => 'End date for voting (leave it blank for "Manual Control")',	
	'voting:vote:n:options:notstarted' => 'Options (%s to choose):',
	'voting:manual:control' => 'Manual',
	'voting:close' => 'Close Votation',
	'voting:open' => 'Open Votation',
	'voting:openwarning' => 'Are you sure you want to open votations now?',
	'voting:closewarning' => 'Are you sure you want to close votations now?',
	'voting:vote_access_id' => 'Who can vote?',
	'voting:label:information_link' => 'Information Link',
	'voting:label:num_choices' => 'Maximun choices to vote',
	'voting:label:auditory' => 'Auditory',
	'voting:label:show_live_result' => 'Show results before the end of voting',
	'voting:label:start_date' => 'Start date for voting',
	'voting:label:end_date' => 'End date for voting',
	'auditory:auditory' => 'Auditory',
	'voting:vote:n:options:not:access' => 'You can\'t vote in this poll, contact with administrators for more information',
	'voting:error:not:permissions' => 'You can\'t vote in this poll',
	'voting:legend:votes' => 'Votes',
	'voting:legend:percent' => 'Percent',
	'voting:yes:auditory' => 'Yes',
	'voting:no:auditory' => 'No',
	'voting:no:show_live_result' => 'No',
	'voting:yes:show_live_result' => 'Yes',
	'voting:voting_type' => 'Votation type',
	'voting:type:normal' => 'Normal',
	'voting:type:condorcet' => 'Preferential',
	'voting:label:voting_type' => 'Votation type',
	
	/**
	 * River
	 */
	'river:create:object:voting' => '%s created a voting %s', 
	
	/**
	 * Widgets
	 */
	 
	'voting:numbertodisplay' => 'Number of voting to display',
	'voting:morevoting' => 'More voting',
	'voting:novoting' => 'No voting',
	'voting:widget:description' => 'Display your latest voting.',
	
	/**
	 * Object View
	 */
	'voting:strapline' => 'Last updated %s by %s',
	
	/**
	 * Group View
	 */
	'voting:group' => 'Group voting',
	'voting:enablevoting' => 'Enable group voting',
	
	/**
	 * Owner
	 */
	'voting:owner' => "%s's voting",
	
	/**
	 * Friends
	 */
	'voting:friends' => "Friends' voting",  
	
	/**
	 * Estatus and error messages
	 */
	'voting:error:no_title' => 'You must specify a title for this voting.',
	'voting:error:no_save' => 'voting could not be saved',
	'voting:saved' => 'voting saved',
	'voting:error:notsaved' => 'voting could not be saved',
	'voting:delete:success' => 'The voting was successfully deleted.',
	'voting:delete:failed' => 'The voting could not be deleted.',
	'voting:noaccess' => 'Sorry, you have no access to this item', 
	
	/**
	 * voting plugin settings
	 */
	'voting:plugins:settings:explanation' => 'This options will not chage anything, this page has been created by Elgg-Skeletor, the values of this options are saved in the voting configuration and can be accessed by the function elgg_get_plugin_setting(\'voting_option1\', \'voting\') (to access to the option1 value) or elgg_get_plugin_setting(\'voting_option2\', \'voting\') (to access to the option2 value).',
	
	/*
	 * Voting extra strings
	 */ 
	'voting:vote:an:option' => 'Vote for an option:',
	'voting:results' => 'Results of "%s"',
);

add_translation('en', $mapping);
