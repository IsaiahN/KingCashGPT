<?php
/**
*
* acp_prune [French]
*
* @package language
* @version 1.1.1
* @author Maël Soucaze (Maël Soucaze) <maelsoucaze@phpbb.com> http://mael.soucaze.com/
* @author Elglobo (Mickaël Salfati) <elglobo@phpbb.com> http://www.phpbb-services.com/
* @copyright (c) 2005 phpBB Group, 2005 phpBB.fr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

// User pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_USERS_EXPLAIN'	=> 'Cette section vous autorise à supprimer ou à désactiver des utilisateurs sur votre forum. Les comptes peuvent être filtrés de différentes manières ; par le nombre de messages, l’activité la plus récente, etc. Des critères peuvent être combinés afin de restreindre les comptes qui sont affectés. Par exemple, vous pouvez délester les utilisateurs qui ont moins de 10 messages et qui sont également inactifs depuis le 01-01-2002. Alternativement, vous pouvez ignorer complètement la sélection de critères en saisissant directement une liste d’utilisateurs dans le champ de texte, chacun sur une ligne séparée. Soyez prudent avec cette fonctionnalité ! Une fois qu’un utilisateur a été supprimé, vous ne pourrez pas revenir en arrière.',

	'DEACTIVATE_DELETE'			=> 'Désactiver ou supprimer ',
	'DEACTIVATE_DELETE_EXPLAIN'	=> 'Choisissez entre désactiver les utilisateurs ou les supprimer entièrement. Veuillez noter que les utilisateurs supprimés ne peuvent pas être restaurés !',
	'DELETE_USERS'				=> 'Supprimer',
	'DELETE_USER_POSTS'			=> 'Supprimer les messages des utilisateurs délestés ',
	'DELETE_USER_POSTS_EXPLAIN' => 'Supprime les messages des utilisateurs délestés. Cela n’a aucun effet si les utilisateurs sont désactivés.',

	'JOINED_EXPLAIN'			=> 'Saisissez une date au format <kbd>AAAA-MM-JJ</kbd>.',

	'LAST_ACTIVE_EXPLAIN'		=> 'Saisissez une date au format <kbd>AAAA-MM-JJ</kbd>. Saisissez <kbd>0000-00-00</kbd> afin de délester les utilisateurs qui ne se sont jamais connectés, les conditions <em>Avant</em> et <em>Après</em> seront ignorées.',

	'PRUNE_USERS_LIST'				=> 'Utilisateurs à délester',
	'PRUNE_USERS_LIST_DELETE'		=> 'En accord au critère que vous avez sélectionné concernant le délestage des utilisateurs, les comptes suivants seront supprimés.',
	'PRUNE_USERS_LIST_DEACTIVATE'	=> 'En accord au critère que vous avez sélectionné concernant le délestage des utilisateurs, les comptes suivants seront désactivés.',

	'SELECT_USERS_EXPLAIN'		=> 'Veuillez saisir ici des noms d’utilisateurs spécifiques. Ils seront utilisés de préférence en tenant compte des critères présents ci-dessus. Les fondateurs ne peuvent pas être délestés.',

	'USER_DEACTIVATE_SUCCESS'	=> 'Les utilisateurs que vous avez sélectionnés ont été désactivés avec succès.',
	'USER_DELETE_SUCCESS'		=> 'Les utilisateurs que vous avez sélectionnés ont été supprimés avec succès.',
	'USER_PRUNE_FAILURE'		=> 'Aucun utilisateur ne correspond au critère sélectionné.',

	'WRONG_ACTIVE_JOINED_DATE'	=> 'La date que vous avez spécifiée est incorrecte, elle doit obligatoirement être au format <kbd>AAAA-MM-JJ</kbd>.',
));

// Forum Pruning
$lang = array_merge($lang, array(
	'ACP_PRUNE_FORUMS_EXPLAIN'	=> 'Ceci supprimera tous les sujets qui n’ont obtenus aucune réponse ou qui n’ont pas été consultés depuis un certain nombre de jours. Si vous ne saisissez aucun numéro, tous les sujets seront alors supprimés. Par défaut, les sujets dont un sondage est en cours, les notes et les annonces ne seront pas supprimés.',

	'FORUM_PRUNE'		=> 'Délester le forum',

	'NO_PRUNE'			=> 'Aucun forum n’a été délesté.',

	'SELECTED_FORUM'	=> 'Forum sélectionné',
	'SELECTED_FORUMS'	=> 'Forums sélectionnés',

	'POSTS_PRUNED'					=> 'Messages délestés',
	'PRUNE_ANNOUNCEMENTS'			=> 'Délester les annonces',
	'PRUNE_FINISHED_POLLS'			=> 'Délester les sondages terminés',
	'PRUNE_FINISHED_POLLS_EXPLAIN'	=> 'Supprime les sujets dans lesquels les sondages sont terminés.',
	'PRUNE_FORUM_CONFIRM'			=> 'Êtes-vous sûr de vouloir délester les forums sélectionnés avec les réglages que vous avez spécifiés ? Une fois supprimés, les messages et les sujets délestés ne pourront pas être restaurés.',
	'PRUNE_NOT_POSTED'				=> 'Nombre de jours depuis la dernière publication',
	'PRUNE_NOT_VIEWED'				=> 'Nombre de jours depuis la dernière consultation',
	'PRUNE_OLD_POLLS'				=> 'Délester les anciens sondages',
	'PRUNE_OLD_POLLS_EXPLAIN'		=> 'Supprime les sujets dans lesquels les sondages en cours ne contiennent aucun vote.',
	'PRUNE_STICKY'					=> 'Délester les notes',
	'PRUNE_SUCCESS'					=> 'Le délestage des forums a été effectué avec succès.',

	'TOPICS_PRUNED'		=> 'Sujets délestés',
));

?>