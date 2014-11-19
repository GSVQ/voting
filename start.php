<?php /**
 * Describe plugin here
 */

elgg_register_event_handler('init', 'system', 'voting_init');

function voting_init() {
	// Rename this function based on the name of your plugin and update the
	// elgg_register_event_handler() call accordingly
	
	// Register library
	$root = dirname(__FILE__);
	elgg_register_library('skeletor:voting', "$root/lib/voting.php");
	
	//elgg_register_library('phpColors', "$root/lib/Colors.php");
	//elgg_register_js('flot', "mod/voting/vendors/jquery.flot.js");
	//elgg_register_js('flot:pie', "mod/voting/vendors/jquery.flot.pie.js");
	
	elgg_register_js('chartjs', "mod/voting/lib/chartjs/Chart.js");
	// Register a script to handle (usually) a POST request (an action)
	$base_dir = elgg_get_plugins_path() . 'voting/actions/voting';
	elgg_register_action('voting/edit', "$base_dir/edit.php");
	elgg_register_action('voting/delete', "$base_dir/delete.php");
	elgg_register_action('voting/vote', "$base_dir/vote.php");
	elgg_register_action('voting/close', "$base_dir/close.php");
	elgg_register_action('voting/open', "$base_dir/open.php");
	
	// routing of urls
	elgg_register_page_handler('voting', 'voting_page_handler');
	
	// Extend the main CSS file
	elgg_extend_view('css/elgg', 'voting/css');
	
	// Register for search.
	elgg_register_entity_type('object', 'voting');
	
	// add a voting widget
	elgg_register_widget_type('voting', elgg_echo('voting'), elgg_echo('voting:widget:description'));
	
	// Add a menu item to the main site menu
	$item = new ElggMenuItem('voting', elgg_echo('voting:menu'), 'voting');
	elgg_register_menu_item('site', $item);
	
	// Set the config fields of voting
	elgg_set_config('voting', array(
		'title' => 'text',
		'description' => 'longtext',
		'information_link' => 'url',
		'tags' => 'tags',
		'options' => 'auto_add_text',
		'num_choices' => 'integer',
		'access_id' => 'access',
		'vote_access_id' => 'write_access',
		'auditory' => 'checkbox',
		'show_live_result' => 'checkbox',
		'start_date' => 'date',
		'end_date' => 'date',
				
	));
	
	// Register url handler
	elgg_register_entity_url_handler('object', 'voting', 'voting_url');
	
	//elgg_register_plugin_hook_handler('register', 'menu:page', 'voting_page_menu');
	
	// Register owner block menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'voting_owner_block_menu');
	
	// Groups
	add_group_tool_option('voting', elgg_echo('voting:enablevoting'), false);
	elgg_extend_view('groups/tool_latest', 'voting/group_module');
	
	// write permission plugin hooks
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'voting_write_permission_check');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', 'voting_container_permission_check');
	
	// icon url override
	elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'voting_icon_url_override');
	
	
}

/**
 * Dispatches voting pages.
 * URLs take the form of
 *  All voting:       voting/all
 *
 * @param array $page
 * @return bool
 */
function voting_page_handler($page) {
	elgg_load_library('skeletor:voting');
	if (!isset($page[0])) {
		$page[0] = 'all';
	}
	elgg_push_breadcrumb(elgg_echo('voting'), 'voting/all');
	$base_dir = elgg_get_plugins_path() . 'voting/pages/voting';
	$page_type = $page[0];
	switch ($page_type) {
		case 'all':
			include "$base_dir/all.php";
			break;
		case 'edit' :
			
			set_input('guid', $page[1]);
			include "$base_dir/edit.php";
			break;
		case 'add':
			//set_input('guid', $page[1]);
			
			include "$base_dir/edit.php";
			break;
		case 'view':
			set_input('guid', $page[1]);
			include "$base_dir/view.php";
			break;
		case 'friends':
			include "$base_dir/friends.php";
			break;
		case 'owner':
			include "$base_dir/owner.php";
			break;
		case 'group':
			
			include "$base_dir/owner.php";
			break;
		default:
			return false;
	}

	return true;
}

/**
 * Add a menu item to an ownerblock
 * 
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function voting_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "voting/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('voting', elgg_echo('voting'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->voting_enable != 'no') {
			$url = "voting/group/{$params['entity']->guid}/all";
			$item = new ElggMenuItem('voting', elgg_echo('voting:group'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add a page menu menu.
 *
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 * A completar cuando se tenga claro
function voting_page_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		// only show voting menu in voting pages
		if (elgg_in_context('voting')) {
			$page_owner = elgg_get_page_owner_entity();
			if (!$page_owner) {
				$page_owner = elgg_get_logged_in_user_entity();
			}

			if ($page_owner instanceof ElggGroup) {
				if (!$page_owner->isMember()) {
					return $return;
				}
				$title = elgg_echo('voting:menu:group');
			} else {
				$title = elgg_echo('voting:menu');
			}

			$return[] = new ElggMenuItem('voting_page_menu', $title, 'voting/group/' . $page_owner->getGUID());
		}
	}

	return $return;
}
*/

/**
 * Populates the ->getUrl() method for voting objects
 *
 * @param ElggEntity $entity The voting object
 * @return string voting item URL
 */
function voting_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "voting/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Extend permissions checking to extend can-edit for write users.
 *
 * @param string $hook
 * @param string $entity_type
 * @param bool   $returnvalue
 * @param array  $params
 */
function voting_write_permission_check($hook, $entity_type, $returnvalue, $params) {
	if ($params['entity']->getSubtype() == 'voting') {

		$write_permission = $params['entity']->write_access_id;
		$user = $params['user'];

		if ($write_permission && $user) {
			switch ($write_permission) {
				case ACCESS_PRIVATE:
					// Elgg's default decision is what we want
					return;
					break;
				case ACCESS_FRIENDS:
					$owner = $params['entity']->getOwnerEntity();
					if ($owner && $owner->isFriendsWith($user->guid)) {
						return true;
					}
					break;
				default:
					$list = get_access_array($user->guid);
					if (in_array($write_permission, $list)) {
						// user in the access collection
						return true;
					}
					break;
			}
		}
	}
}

/**
 * Extend container permissions checking to extend can_write_to_container for write users.
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function voting_container_permission_check($hook, $entity_type, $returnvalue, $params) {

	if (elgg_get_context() == "voting") {
		if (elgg_get_page_owner_guid()) {
			if (can_write_to_container(elgg_get_logged_in_user_guid(), elgg_get_page_owner_guid())) return true;
		}
		if ($voting_guid = get_input('voting_guid',0)) {
			$entity = get_entity($voting_guid);
		}
		if ($entity instanceof ElggObject) {
			if (
					can_write_to_container(elgg_get_logged_in_user_guid(), $entity->container_guid)
					|| in_array($entity->write_access_id,get_access_list())
				) {
					return true;
			}
		}
	}

}

/**
 * Override the default entity icon for voting
 *
 * @return string Relative URL
 */
function voting_icon_url_override($hook, $type, $returnvalue, $params) {
	$entity = $params['entity'];
	if (elgg_instanceof($entity, 'object', 'voting')) {
		
		switch ($params['size']) {
			case 'topbar':
				return 'mod/voting/images/topbar.png';
				break;
			case 'tiny':
				return 'mod/voting/images/tiny.png';
				break;
			case 'small':
				return 'mod/voting/images/small.png';
				break;
			case 'medium':
				return 'mod/voting/images/medium.png';
				break;
			case 'large':
				return 'mod/voting/images/large.png';
				break;
			default:
				return 'mod/voting/images/medium.png';
				break;
		}
	}
}






