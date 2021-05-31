<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\models\forms;

use app\models\PostTags;

use yii\base\Model;


/**
 *
 */
class postTagsFrom extends Model
{   
    public $skill;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['skill', 'string'],
            ['skill', 'exist', 'targetClass' => PostcTags::class, 'targetAttribute' => 'skill', ]
            
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skill' => 'ajouter une compétence :'
        ];
    }

   /**
    * signs postTags up
    */
    public function signup()
    {
    
       
        $skill= new PostTags();
        $skill->skill=$this->skill;
        if($skill->validate())
        {
            
            $skill->save();
            return $skill;
        } 
    }

    
}
