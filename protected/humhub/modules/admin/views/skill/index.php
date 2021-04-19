<?php

use humhub\compat\HForm;
use humhub\libs\Html;
use humhub\widgets\Link;
use humhub\modules\user\models\ProfileField;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $field ProfileField */
/* @var $hForm HForm */

?>
<div class="panel-body">
    <div class="pull-right">
        <?= Link::success(Yii::t('AdminModule.user', 'Create new group'))->href(Url::to(['edit']))->sm()->icon('add') ?>
    </div>
<div id="edit-profile-field-root" class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'skill') ?>
    <?php ActiveForm::end(); ?>
    <div class="form-group">
        <?= Html::submitButton('Soumettre', ['class' => 'btn btn-primary']) ?>
    </div>
</div>


