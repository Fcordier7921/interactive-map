<?php


namespace myCompany\humhub\modules\recherche\controllers;

use app\models\PostTags;
use humhub\components\Controller;
use app\models\User;
use app\models\UserQuery;

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
        //renvoyer mes utilisateur
        $users = User::find()->with('profile')->all();
        
        //renvoyer le compétence
        $queryPostTags = PostTags::find()->all();

        if (sleep(5)) {
            header("Location: /index.php?r=recherche%2Findex");
            exit;
        }
        return $this->render('index', [
            'users' => $users,
            'skill' => $queryPostTags
        ]);
    }
}
