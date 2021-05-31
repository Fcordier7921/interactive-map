<?php

namespace myCompany\humhub\modules\recherche\controllers;

use humhub\modules\admin\components\Controller;
use yii\helpers\VarDumper;
class AdminController extends Controller
{

    /**
     * Render admin only page
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    

}

