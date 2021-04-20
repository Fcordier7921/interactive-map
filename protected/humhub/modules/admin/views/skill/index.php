<?php


use yii\helpers\Html;
use humhub\widgets\Tabs;
use yii\widgets\ActiveForm;

/* @var $field ProfileField */
/* @var $hForm HForm */

?>
<style>

    label{
        margin-right: 2rem;
        margin-bottom: 1rem!important;
    }
    .check{
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
                <?php if (count($skills) > 0) : ?>
                    <form class="check">
                        <?php foreach ($skills as $skill) : ?>
                            <div>
                                <input type="checkbox" id="<?php echo $skill->skill; ?>" name="<?php echo $skill->skill; ?>">
                                <label for="<?php echo $skill->skill; ?>"><?php echo $skill->skill; ?></label>
                            </div>
                        <?php endforeach ?>
                        
                    </form>
                    <input class="del" type="submit" value="supprimer">
                <?php else : ?>
                    <p>Aucun compétence d'enregistrer</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>