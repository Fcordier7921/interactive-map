<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PostTags]].
 *
 * @see PostTags
 */
class PosttagsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PostTags[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PostTags|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
