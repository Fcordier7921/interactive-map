<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $class
 * @property string|null $module
 * @property string|null $object_model
 * @property int $object_id
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class', 'object_id'], 'required'],
            [['object_id'], 'integer'],
            [['class', 'module', 'object_model'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => 'Class',
            'module' => 'Module',
            'object_model' => 'Object Model',
            'object_id' => 'Object ID',
        ];
    }
}
