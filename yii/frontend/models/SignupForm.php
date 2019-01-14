<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $phone;
    public $first_name;
    public $last_name;
    public $country;
    public $city;
    public $gender;
    public $birthday;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],


            ['phone', 'required'],
            ['first_name', 'required'],
            ['last_name', 'required'],
            ['country', 'required'],
            ['city', 'required'],
            ['gender', 'required'],
            ['birthday', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->country = $this->country;
        $user->phone = $this->phone;
        $user->city = $this->city;
        $user->gender = $this->gender;
        $user->birthday = $this->birthday;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
