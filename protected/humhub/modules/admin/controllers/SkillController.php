<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\controllers;

use humhub\modules\admin\models\forms\postTagsFrom;
use app\models\PostTags;
use Yii;
use humhub\modules\admin\components\Controller;
use yii\data\Pagination;

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
        
        //ajout d'une compétence
        $model = new postTagsFrom;
        if ($model->load(Yii::$app->request->post())) {
            $model->signup();
            header("Location: /index.php?r=admin%2Fskill");
            exit;
        }
        //affichage des donné avec pagination
        $query = PostTags::find();
        $pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 7]);
        
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['id'=>SORT_DESC])
            ->all();
        
        return $this->render('index', [
            'skills' => $articles,
            'models' => $model,
            'pagination'=>$pagination
        ]);
    }


    public function actionDelete($id)
    {
        $skill = PostTags::findOne($id);
        if (empty($skill)) {
            return;
        }

        $skill->delete();
        if ($skill) {
            yii::$app->getSession()->setFlash('message', 'Skill suprimer');
            return $this->redirect(['/admin/skill/index']);
        }
    }
}
