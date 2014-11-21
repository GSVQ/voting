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
	'voting:menu' => 'Votaciones',
	'voting:none' => 'No hay ninguna votación',
	'voting:add' => 'Agregar Votación',
	'voting' => 'votaciones',
	'voting:all' => 'Todas las votaciones',
	'voting:title' => 'Nombre de la votación',
	'voting:description' => 'Descripción de la votación',
	'voting:tags' => 'Etiquetas',
	'voting:access_id' => 'Quién puede ver la votación',
	'voting:write_access_id' => 'Quien puede editar la votación',
	'item:object:voting' => 'Votaciones',
	'voting:edit' => 'Editar %s',
	'voting:legend:result' => 'Resultados:',
	'voting:legend:total:votes' => 'Votos totales',
	'voting:legend:voting:of' => 'Votos de',
	"voting:vote:n:options" => 'Elige hasta %s opciones',
	'voting:error:toomany:optionchoosen' => 'Error: Has elegido %s opciones siendo el límite %s',
	'voting:error:thereis:votes' => 'No puedes editar la votación: ya hay votos emitidos',
	'voting:information_link' => 'Enlace a información adicional',
	'voting:num_choices' => 'Máximo número de opciones que se pueden votar',
	'voting:auditory' => 'Auditoría (Establece si se muestra la lista con las opciones que votó cada usuario)',
	'voting:show_live_result' => 'Mostrar resultados aunque no haya finalizado la votación',
	'voting:start_date' => 'Fecha de inicio (Dejar en blanco para tomar la fecha actual)',
	'voting:end_date' => 'Fecha final (Dejar en blanco para tener un "Control Manual")',	
	'voting:vote:n:options:notstarted' => 'Opciones (A elegir %s):',
	'voting:manual:control' => 'Manual',
	'voting:close' => 'Cerrar Votación',
	'voting:open' => 'Abrir Votación',
	'voting:openwarning' => '¿Estás seguro de que quieres abrir la votación?',
	'voting:closewarning' => '¿Estás seguro de que quieres cerrar la votación?',
	'voting:vote_access_id' => 'Quién puede votar',
	'voting:label:information_link' => 'Enlace a información adicional',
	'voting:label:num_choices' => 'Máximo número de opciones a elegir',
	'voting:label:auditory' => 'Auditoría',
	'voting:label:show_live_result' => 'Mostrar resultados durante el proceso',
	'voting:label:start_date' => 'Fecha de inicio de las votaciones',
	'voting:label:end_date' => 'Fecha final de las votaciones',
	'auditory:auditory' => 'Auditoría de recuento',
	'voting:vote:n:options:not:access' => 'No puedes votar en esta votación, si quieres participar comprueba que estás logueado y que perteneces al grupo donde se abrió la votación, si aún así sigue apareciendo este mensaje, consulta con los administradores del sitio',
	'voting:error:not:permissions' => 'Error: No puedes votar en esta votación',
	'voting:legend:votes' => 'Votos',
	'voting:legend:percent' => 'Porcentaje',
	'voting:yes:auditory' => 'Si',
	'voting:no:auditory' => 'No',
	'voting:no:show_live_result' => 'No',
	'voting:yes:show_live_result' => 'Si',

	/**
	 * River
	 */
	'river:create:object:voting' => '%s ha creado una %s', 
	
	/**
	 * Widgets
	 */
	 
	'voting:numbertodisplay' => 'Número de votaciones que se muestran',
	'voting:morevoting' => 'Más votaciones',
	'voting:novoting' => 'No hay votaciones',
	'voting:widget:description' => 'Muestra las últimas votaciones.',
	
	/**
	 * Object View
	 */
	'voting:strapline' => 'Última actualización %s por %s',
	
	/**
	 * Group View
	 */
	'voting:group' => 'Votaciones del grupo',
	'voting:enablevoting' => 'Activar votaciones',
	
	/**
	 * Owner
	 */
	'voting:owner' => "Votaciones creadas por %s",
	
	/**
	 * Friends
	 */
	'voting:friends' => "Votaciones de amigos",  
	
	/**
	 * Estatus and error messages
	 */
	'voting:error:no_title' => 'Debes especificar un título de la votación',
	'voting:error:no_save' => 'La votación no pudo guardarse',
	'voting:saved' => 'Votación guardada',
	'voting:error:notsaved' => 'La votación no pudo guardarse',
	'voting:delete:success' => 'La votación se ha borrado correctamente',
	'voting:delete:failed' => 'La votación no pudo borrarse',
	'voting:noaccess' => 'Lo sentimos, no tienes permisos para este objeto', 
	
	/**
	 * voting plugin settings
	 */
	'voting:plugins:settings:explanation' => 'Estas opciones no cambian nada, esta página ha sido creada por Elgg-Skeletor (by aruberuto), los valores de estas opciones son guardados en la configuración del plugin y pueden usarse mediante la función elgg_get_plugin_setting(\'voting_option1\', \'voting\') (para acceder al valor de votin_option1) o con la función elgg_get_plugin_setting(\'voting_option2\', \'voting\') (para acceder al valor de la opcion2).',
	
	/*
	 * Voting extra strings
	 */ 
	'voting:vote:an:option' => 'Votar una opción:',
	'voting:results' => 'Resultados de "%s"',
);

add_translation('es', $mapping);
