<?php

namespace app\models;

use Codeception\Lib\Generator\Group;
use Codeception\Lib\Notification;
use Codeception\Step\Comment;
use Faker\Provider\File;
use humhub\modules\calendar\models\CalendarEntryParticipant;
use humhub\modules\like\models\Like;
use humhub\modules\mail\models\MessageTag;
use humhub\modules\space\tests\codeception\fixtures\SpaceMembershipFixture;
use humhub\modules\user\activities\UserFollow;
use humhub\modules\user\models\GroupUser;
use humhub\modules\user\tests\codeception\fixtures\UserMentioningFixture;
use humhub\modules\user\tests\codeception\fixtures\UserPasswordFixture;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string|null $guid
 * @property int|null $status
 * @property string|null $username
 * @property string|null $email
 * @property string $auth_mode
 * @property string|null $tags
 * @property string|null $language
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $last_login
 * @property int|null $visibility
 * @property string|null $time_zone
 * @property int|null $contentcontainer_id
 * @property string|null $authclient_id
 *
 * @property CalendarEntryParticipant[] $calendarEntryParticipants
 * @property Comment[] $comments
 * @property Content[] $contents
 * @property Content[] $contents0
 * @property File[] $files
 * @property GroupUser[] $groupUsers
 * @property Group[] $groups
 * @property Like[] $likes
 * @property Like[] $likes0
 * @property MessageTag[] $messageTags
 * @property Notification[] $notifications
 * @property Profile $profile
 * @property SpaceMembership[] $spaceMemberships
 * @property UserAuth[] $userAuths
 * @property UserFollow[] $userFollows
 * @property UserFriendship[] $userFriendships
 * @property UserFriendship[] $userFriendships0
 * @property User[] $users
 * @property User[] $friendUsers
 * @property UserHttpSession[] $userHttpSessions
 * @property UserMentioning[] $userMentionings
 * @property UserPassword[] $userPasswords
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by', 'visibility', 'contentcontainer_id'], 'integer'],
            [['auth_mode'], 'required'],
            [['tags'], 'string'],
            [['created_at', 'updated_at', 'last_login'], 'safe'],
            [['guid'], 'string', 'max' => 45],
            [['username'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['auth_mode'], 'string', 'max' => 10],
            [['language'], 'string', 'max' => 5],
            [['time_zone'], 'string', 'max' => 100],
            [['authclient_id'], 'string', 'max' => 60],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['guid'], 'unique'],
            [['authclient_id'], 'unique'],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guid' => 'Guid',
            'status' => 'Status',
            'username' => 'Username',
            'email' => 'Email',
            'auth_mode' => 'Auth Mode',
            'tags' => 'Tags',
            'language' => 'Language',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'last_login' => 'Last Login',
            'visibility' => 'Visibility',
            'time_zone' => 'Time Zone',
            'contentcontainer_id' => 'Contentcontainer ID',
            'authclient_id' => 'Authclient ID',
        ];
    }

    /**
     * Gets query for [[CalendarEntryParticipants]].
     *
     * @return \yii\db\ActiveQuery|CalendarEntryParticipantQuery
     */
    public function getCalendarEntryParticipants()
    {
        return $this->hasMany(CalendarEntryParticipant::className(), ['user_id' => 'id']);
    }



    /**
     * Gets query for [[GroupUsers]].
     *
     * @return \yii\db\ActiveQuery|GroupUserQuery
     */
    public function getGroupUsers()
    {
        return $this->hasMany(GroupUser::className(), ['user_id' => 'id']);
    }

   

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery|LikeQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Likes0]].
     *
     * @return \yii\db\ActiveQuery|LikeQuery
     */
    public function getLikes0()
    {
        return $this->hasMany(Like::className(), ['target_user_id' => 'id']);
    }

    /**
     * Gets query for [[MessageTags]].
     *
     * @return \yii\db\ActiveQuery|MessageTagQuery
     */
    public function getMessageTags()
    {
        return $this->hasMany(MessageTag::className(), ['user_id' => 'id']);
    }

    

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery|ProfileQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SpaceMemberships]].
     *
     * @return \yii\db\ActiveQuery|SpaceMembershipQuery
     */
    public function getSpaceMemberships()
    {
        return $this->hasMany(SpaceMembershipFixture::className(), ['user_id' => 'id']);
    }

  
    /**
     * Gets query for [[UserFollows]].
     *
     * @return \yii\db\ActiveQuery|UserFollowQuery
     */
    public function getUserFollows()
    {
        return $this->hasMany(UserFollow::className(), ['user_id' => 'id']);
    }

    

 

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_friendship}}', ['friend_user_id' => 'id']);
    }

    /**
     * Gets query for [[FriendUsers]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getFriendUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'friend_user_id'])->viaTable('{{%user_friendship}}', ['user_id' => 'id']);
    }

    /*

    /**
     * Gets query for [[UserMentionings]].
     *
     * @return \yii\db\ActiveQuery|UserMentioningQuery
     */
    public function getUserMentionings()
    {
        return $this->hasMany(UserMentioningFixture::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserPasswords]].
     *
     * @return \yii\db\ActiveQuery|UserPasswordQuery
     */
    public function getUserPasswords()
    {
        return $this->hasMany(UserPasswordFixture::className(), ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
