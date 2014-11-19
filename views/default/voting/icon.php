<?php
/**
 * voting icon
 *
 * @package voting
 *
 * @uses $vars['entity_guid']
 * 
 */

$guid = $vars['entity_guid'];
$entity = get_entity($guid);

// Get size
if (!in_array($vars['size'], array('small', 'medium', 'large', 'tiny', 'master', 'topbar'))) {
	$vars['size'] = "medium";
}

?>

<a href="<?php echo $entity->getURL(); ?>">
	<img alt="<?php echo $entity->title; ?>" src="<?php echo $entity->getIconURL($vars['size']); ?>" />
</a>
