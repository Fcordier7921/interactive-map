<?php

namespace  myCompany\humhub\modules\interactivemap;

use Yii;
use yii\helpers\Url;

class Events
{
    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Interactivemap',
            'icon' => '<i class="fa fa-archive"></i>',
            'url' => Url::to(['/interactivemap/index']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'interactivemap' && Yii::$app->controller->id == 'index'),
        ]);
    }

    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem([
            'label' => 'Interactivemap',
            'url' => Url::to(['/interactivemap/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-archive"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'interactivemap' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ]);
    }
}
