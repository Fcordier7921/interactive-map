<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\controllers;

use humhub\modules\admin\models\forms\postTagsFrom;
use app\models\PostTags;
use humhub\modules\admin\permissions\ManageUsers;
use Yii;
use yii\web\HttpException;
use humhub\compat\HForm;
use humhub\modules\admin\components\Controller;
use humhub\modules\user\models\ProfileFieldCategory;
use humhub\modules\user\models\ProfileField;
use humhub\modules\user\models\fieldtype\BaseType;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Skill Administration Controller
 *
 * @since 0.5
 */
class SkillController extends Controller
{



    /**
     * @inheritdoc
     */
    public function init()
    {

        $this->appendPageTitle(Yii::t('AdminModule.base', 'skill'));


        return parent::init();
    }

    /**
     * Shows overview of all
     *
     */
    public function actionIndex()
    {
        $model = new postTagsFrom;

        if ($model->load(Yii::$app->request->post())) {
            $model->signup();
            header("Location: http://humhub-1.8.1.test/index.php?r=admin%2Fskill");
            exit;
        }
        $skill = PostTags::find()->all();

        return $this->render('index', [
            'skills' => $skill,
            'models' => $model,

        ]);
    }
}
