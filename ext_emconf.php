<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "jh_pwcomments_captcha".
 *
 * Auto generated 31-10-2014 10:37
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'pwComments captcha',
	'description' => 'Adds a captcha to the comments-form of EXT:pw_comments. Supports EXT:captcha and EXT:sr_freecap.',
	'category' => 'plugin',
	'version' => '0.1.0',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Jonathan Heilmann',
	'author_email' => 'mail@jonathan-heilmann.de',
	'author_company' => '',
	'constraints' =>
	array (
		'depends' =>
		array (
			'typo3' => '6.2.0-6.2.99',
			'pw_comments' => '3.0.0',
		),
		'conflicts' =>
		array (
		),
		'suggests' =>
		array (
		),
	),
);

