<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace app\models\form;


use Yii;
use yii\base\Model;
use app\models\PostTags;

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
            ['skill', 'string']
        ];
    }

    
   

}
