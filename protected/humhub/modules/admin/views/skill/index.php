<?php

use humhub\widgets\LinkPager;
use yii\helpers\Html;
use humhub\widgets\Tabs;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $field ProfileField */
/* @var $hForm HForm */

?>
<style>
    label {
        margin-right: 2rem;
        margin-bottom: 1rem !important;
    }

    .check {
        display: flex;
        flex-flow: wrap;
    }
</style>
<?php $this->beginContent('@admin/views/layouts/main.php') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('AdminModule.user', '<strong>User</strong> administration'); ?>
    </div>
    <?= \humhub\modules\admin\widgets\UserMenu::widget(); ?>
    <div class="panel-body">

        <div id="edit-profile-field-root" class="panel-body">
            <?php
            if (yii::$app->session->hasFlash('success')) {
                echo yii::$app->session->getFlash('success');
            } ?>

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($models, 'skill'); ?>


            <?= Html::submitButton('envoyer', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end(); ?>
            <h4>Les compétences disponibles :</h4>
            <div>
                <table class="table table-hover">
                   
                    <tbody>

                        <?php if (count($skills) > 0) : ?>
                            <?php foreach ($skills as $skill) : ?>

                                <tr class="table-active">
                                    <th scope="row"><?php echo $skill->skill; ?></th>
                                    <th><samp><?= Html::a('suprimer', Url::toRoute(['/admin/skill/delete', 'id' => $skill->id]), ['class' => 'btn btn-danger btn-sm']) ?></samp></th>

                                </tr>

                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td>Aucun compétence d'enregistrer</td>
                            </tr>

                        <?php endif ?>
                    </tbody>

                </table>
                <?=  LinkPager::widget([
                    "pagination" => $pagination,
                ]); ?>
            </div>
        </div>
    </div>
</div>
