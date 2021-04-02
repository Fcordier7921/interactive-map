<?php

namespace  myCompany\humhub\modules\recherche;

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
            'label' => 'Recherche',
            'icon' => '<i class="fa fa-search"></i>',
            'url' => Url::to(['/recherche/index']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'recherche' && Yii::$app->controller->id == 'index'),
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
            'label' => 'Recherche',
            'url' => Url::to(['/recherche/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-search"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'recherche' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ]);
    }
}
