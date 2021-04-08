<?php

namespace app\models;
use yii\db\ActiveQuery;
/**
 * This is the ActiveQuery class for [[User]].
 *
 * @see User
 */
class UserQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return User[]|array
     */
    public function all($db = null)
    {   
      
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     * @return User[]|array
     */
    public  function allprofil($db=null)
    {   
        $datas = parent::all($db);
        $allProfil=[];
        foreach($datas as $k=>$data){
            $allProfil[$k]['user']=$data->username;
            $allProfil[$k]['profile']=$data->getProfile()->firstname;
        }
        return $allProfil;

        // $query=(new \yii\db\Query())
        // ->select(['c.id', 'c.guid', 'c.username', 'c.email', 'c.tags', 'c.language', 'p.user_id', 'p.firstname', 'p.lastname', 'p.gender', 'p.street', 'p.zip', 'p.city', 'p.country' ])
        // ->from('user c')
        // ->join('LEFT JOIN', 'profile p', 'p.user_id = c.id')
        // ->all();
        // return parent::allprofil($query);
    }
}
