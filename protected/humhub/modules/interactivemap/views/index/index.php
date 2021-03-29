<?php

use humhub\widgets\Button;

// Register our module assets, this could also be done within the controller
\myCompany\humhub\modules\interactivemap\assets\Assets::register($this);

$displayName = (Yii::$app->user->isGuest) ? Yii::t('InteractivemapModule.base', 'Guest') : Yii::$app->user->getIdentity()->displayName;

// Add some configuration to our js module
$this->registerJsConfig("interactivemap", [
    'username' => (Yii::$app->user->isGuest) ? $displayName : Yii::$app->user->getIdentity()->username,
    'text' => [
        'hello' => Yii::t('InteractivemapModule.base', 'Hi there {name}!', ["name" => $displayName])
    ]
])

?>

<div class="panel-heading"><strong>Interactivemap</strong> <?= Yii::t('InteractivemapModule.base', 'overview') ?></div>

<div class="panel-body">
    <p><?= Yii::t('InteractivemapModule.base', 'Hello World!') ?></p>

    <?=  Button::primary(Yii::t('InteractivemapModule.base', 'Say Hello!'))->action("interactivemap.hello")->loader(false); ?></div>
