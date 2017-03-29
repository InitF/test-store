<?php

namespace backend\models;


use yii\base\Model;
use common\models\User;

class UpdateUserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;

    public $isNewRecord = false;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     * @param $user User
     * @return User|null the saved model or null if saving fails
     */
    public function update($user)
    {
        if (!$this->validate()) {
            return null;
        }

        if (!empty($this->username)) $user->username = $this->username;
        if (!empty($this->email)) $user->email = $this->email;
        if (!empty($this->status)) $user->status = $this->status;
        if (!empty($this->password)) $user->setPassword($this->password);

        return $user->save() ? $user : null;
    }
}