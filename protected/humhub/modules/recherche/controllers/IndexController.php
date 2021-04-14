<?php


namespace myCompany\humhub\modules\recherche\controllers;

use humhub\components\Controller;
use app\models\User;


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
        
        for($i=0; $i<count($users); $i++)
        {
            $curl=curl_init("http://open.mapquestapi.com/geocoding/v1/address?key=p7SEPkMy7u1mNlD7jnfoU3KtcLKmdlco&location=".$users[$i]->profile->street.' '.$users[$i]->profile->zip.' '.$users[$i]->profile->city);
            curl_setopt($curl, CURLOPT_CAINFO, __DIR__.DIRECTORY_SEPARATOR. 'cert.cer');// je n'ai pas utiliser surl_setopt_array caar pas pris en compte par le framwerk yii
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            $data=curl_exec($curl);
            if($data === false)
            {
                var_dump(curl_error($curl));
            }
            else
            {
                if(curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200)
                {
                    $data=json_decode($data, true);
                    if(isset($data["results"][0]["locations"][0]["latLng"])){
                        
                        $dataLatLng[$users[$i]->id]= $data["results"][0]["locations"][0]["latLng"];
                        
                        
                    }
                    else
                    {
                        echo'<h1> un erreur est survenu veuiller contacter le créateur du site.</h1>';
                        break;
                    }
                    
                }
                
            }
            curl_close($curl);
        }
        // dd($users);
        // dd($dataLatLng);

        

        return $this->render('index', [
            'users'=> $users,
            'latlng'=> $dataLatLng
        ]);
    }

}

