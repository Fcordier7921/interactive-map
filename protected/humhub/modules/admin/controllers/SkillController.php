<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\controllers;

use app\models\form\postTagsFrom;
use app\models\PostTags;
use humhub\modules\admin\permissions\ManageUsers;
use Yii;
use yii\web\HttpException;
use humhub\compat\HForm;
use humhub\modules\admin\components\Controller;
use humhub\modules\user\models\ProfileFieldCategory;
use humhub\modules\user\models\ProfileField;
use humhub\modules\user\models\fieldtype\BaseType;
use yii\helpers\Url;

/**
 * UserprofileController provides manipulation of the user's profile fields & categories.
 *
 * @since 0.5
 */
class skillController extends Controller
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
        $PosttagsQuery=new PostTags();
        $skill=$PosttagsQuery->all();
        dd($skill);
        return $this->render('skill/index', [
            'skills'=>$skill
        ]);
    }
}