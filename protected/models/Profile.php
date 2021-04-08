<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $user_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $title
 * @property string|null $gender
 * @property string|null $street
 * @property string|null $zip
 * @property string|null $city
 * @property string|null $country
 * @property string|null $state
 * @property int|null $birthday_hide_year
 * @property string|null $birthday
 * @property string|null $about
 * @property string|null $phone_private
 * @property string|null $phone_work
 * @property string|null $mobile
 * @property string|null $fax
 * @property string|null $im_skype
 * @property string|null $im_xmpp
 * @property string|null $url
 * @property string|null $url_facebook
 * @property string|null $url_linkedin
 * @property string|null $url_xing
 * @property string|null $url_youtube
 * @property string|null $url_vimeo
 * @property string|null $url_flickr
 * @property string|null $url_myspace
 * @property string|null $url_twitter
 * @property int|null $champ
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'birthday_hide_year', 'champ'], 'integer'],
            [['birthday'], 'safe'],
            [['about'], 'string'],
            [['firstname', 'lastname', 'title', 'gender', 'street', 'zip', 'city', 'country', 'state', 'phone_private', 'phone_work', 'mobile', 'fax', 'im_skype', 'im_xmpp', 'url', 'url_facebook', 'url_linkedin', 'url_xing', 'url_youtube', 'url_vimeo', 'url_flickr', 'url_myspace', 'url_twitter'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'title' => 'Title',
            'gender' => 'Gender',
            'street' => 'Street',
            'zip' => 'Zip',
            'city' => 'City',
            'country' => 'Country',
            'state' => 'State',
            'birthday_hide_year' => 'Birthday Hide Year',
            'birthday' => 'Birthday',
            'about' => 'About',
            'phone_private' => 'Phone Private',
            'phone_work' => 'Phone Work',
            'mobile' => 'Mobile',
            'fax' => 'Fax',
            'im_skype' => 'Im Skype',
            'im_xmpp' => 'Im Xmpp',
            'url' => 'Url',
            'url_facebook' => 'Url Facebook',
            'url_linkedin' => 'Url Linkedin',
            'url_xing' => 'Url Xing',
            'url_youtube' => 'Url Youtube',
            'url_vimeo' => 'Url Vimeo',
            'url_flickr' => 'Url Flickr',
            'url_myspace' => 'Url Myspace',
            'url_twitter' => 'Url Twitter',
            'champ' => 'Champ',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
}
