<?php

use humhub\compat\HForm;
use humhub\libs\Html;
use humhub\modules\user\models\ProfileField;
use yii\widgets\ActiveForm;

/* @var $field ProfileField */
/* @var $hForm HForm */
?>

<div id="edit-profile-field-root" class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'skill') ?>
    <?php ActiveForm::end(); ?>
    <div class="form-group">
        <?= Html::submitButton('Soumettre', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

