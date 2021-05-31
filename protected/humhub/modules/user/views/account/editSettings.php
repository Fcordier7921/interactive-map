<?php

use app\models\PostTags;
use humhub\libs\TimezoneHelper;
use humhub\modules\user\helpers\AuthHelper;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use yii\helpers\ArrayHelper;
?>
<style>
label {
    
    margin-left: 2rem!important;
}

</style>
<?php $this->beginContent('@user/views/account/_userSettingsLayout.php') ?>

<?php $form = ActiveForm::begin(['id' => 'basic-settings-form']); ?>

    <?php
    $PostTagas = ArrayHelper::map($PostTagas, 'skill', 'skill');
    ?>
    <?= ($form->field($model, 'tags')->checkboxList($PostTagas, ['multiple' => 'multiple']));  ?>


<p>Si vos compétence ne figure pas dans la liste. Veuillez contacter l'administrateur du site <button type="button" class="btn btn-primary" data-action-click="ui.modal.load" data-action-click-url="/index.php?r=mail%2Fmail%2Fcreate&userGuid=3ef2d8cf-3184-440d-9d90-c23fc76e6cbf">Ici</button></p>

<?php if (count($languages) > 1) : ?>
    <?= $form->field($model, 'language')->dropDownList($languages, ['data-ui-select2' => '']); ?>
<?php endif; ?>

<?= $form->field($model, 'timeZone')->dropDownList(TimezoneHelper::generateList(), ['data-ui-select2' => '']); ?>

<?php if (AuthHelper::isGuestAccessEnabled()) : ?>

    <?php
    echo $form->field($model, 'visibility')->dropDownList([
        1 => Yii::t('UserModule.account', 'Registered users only'),
        2 => Yii::t('UserModule.account', 'Visible for all (also unregistered users)'),
    ]);
    ?>


<?php endif; ?>

<?php if (Yii::$app->getModule('tour')->settings->get('enable') == 1) : ?>
    <?= $form->field($model, 'show_introduction_tour')->checkbox(); ?>
<?php endif; ?>

<button class="btn btn-primary" type="submit" data-ui-loader><?= Yii::t('UserModule.account', 'Save') ?></button>

<?php ActiveForm::end(); ?>
<?php $this->endContent(); ?>