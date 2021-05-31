<?php

require_once(__DIR__ . '/functions.php');
/**
 * This file provides to overwrite the default HumHub / Yii configuration by your local Web environments
 * @see http://www.yiiframework.com/doc-2.0/guide-concept-configurations.html
 * @see http://docs.humhub.org/admin-installation-configuration.html
 * @see http://docs.humhub.org/dev-environment.html
 */

return 
[
    'bootstrap' => ['gii'],
    'modules' => 
    [
        'gii' => 
        [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
            'generators' => 
            [
                'module' => 
                [
                    'class' => 'humhub\modules\devtools\gii\generators\ModuleGenerator',
                    'templates' => 
                    [
                        'humhub' => '@app/modules/devtools/default',
                    ]
                ]
            ],
        ],
    ],
];
