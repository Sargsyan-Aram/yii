<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\FileHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $birthday
 * @property string $gender
 * @property string $auth_key
 * @property integer $status
 * @property string $avatar
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $file;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    public function beforeSave($insert)
    {
        $model = new User();
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
        $model->setPassword($this->attributes['password_hash']);
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        TimestampBehavior::className(),
    ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['first_name','last_name'], 'required'],
            [['email'], 'email'],
            [['avatar'], 'image','extensions' => 'jpg, gif, png',],
            [['file'], 'image'],
            [ 'password_hash','string', 'min' => 6],
            [ 'password_hash','required'],
            [['phone', 'country', 'city', 'birthday','gender'], 'required'],
            ['birthday', 'date', 'format' => 'php:Y-m-d'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password_hash' => 'Password',
            'phone' => 'Phone',
            'country' => 'Country',
            'city' => 'City',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function uploadAvatar()
    {
        if ($this->validate($this->avatar)) {
            $user = \Yii::$app->user->identity['attributes'];
            $path = Yii::getAlias('@images').'/userAvatars/'.$user['id'].'_'.$user['first_name'];
            FileHelper::createDirectory($path);
            $image = time().$this->avatar->baseName . '.' . $this->avatar->extension;
            if($this->avatar->saveAs($path.'/'. $image)){
                if (file_exists($path.'/'.Yii::$app->request->post('old_avatar'))){
                    unlink($path.'/'.Yii::$app->request->post('old_avatar'));
                }
                $image_250_x=Yii::$app->image->load($path.'/'. $image);
                $image_250_x->resize('250')->save();
                $customer = User::findOne($user['id']);
                $customer->avatar = $image;
                $customer->update();
            }
            return true;
        } else {
            dd($this->avatar->extension);
            return false;
        }
    }
}
