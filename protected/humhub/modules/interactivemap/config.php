<?php

use myCompany\humhub\modules\interactivemap\Events;
use humhub\modules\admin\widgets\AdminMenu;
use humhub\widgets\TopMenu;

return [
	'id' => 'interactivemap',
	'class' => 'myCompany\humhub\modules\interactivemap\Module',
	'namespace' => 'myCompany\humhub\modules\interactivemap',
	'events' => [
		[
			'class' => TopMenu::class,
			'event' => TopMenu::EVENT_INIT,
			'callback' => [Events::class, 'onTopMenuInit'],
		],
		[
			'class' => AdminMenu::class,
			'event' => AdminMenu::EVENT_INIT,
			'callback' => [Events::class, 'onAdminMenuInit']
		],
	],
];
