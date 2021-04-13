<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%posttags}}".
 *
 * @property string $skill
 */
class PostTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posttags}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['skill'], 'required'],
            [['skill'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'skill' => 'Skill',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PosttagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PosttagsQuery(get_called_class());
    }
}
