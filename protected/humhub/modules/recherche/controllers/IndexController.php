<?php

namespace myCompany\humhub\modules\recherche\controllers;

use humhub\components\Controller;
use app\models\User;
use app\models\UserQuery;
use app\models\Profile;
use yii\data\Pagination;
use yii\helpers\VarDumper;

class IndexController extends Controller
{

    public $subLayout = "@recherche/views/layouts/default";

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        $queryUser=User::find()->with('profile');
        
        $users=$queryUser->all();
        // dd($users);

        return $this->render('index', [
            'users'=> $users,
            
        ]);
    }

}

