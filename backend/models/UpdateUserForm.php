<?php

namespace backend\models;


use yii\base\Model;
use common\models\User;

/**
 * Class UpdateUserForm
 * @package backend\models
 *
 * @property User $objUser
 */
class UpdateUserForm extends Model
{
    private $objUser;

    public $id;
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
            [
                'username',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This username has already been taken.',
                'filter' => ['not', ['id' => $this->id]]
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.',
                'filter' => ['not', ['id' => $this->id]]
            ],

            ['password', 'string', 'min' => 6],
        ];
    }

    public function uniqueValidate()
    {

    }

    public function setAttr(User $user)
    {
        $this->objUser = $user;
        $this->id = $user->id;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->status = $user->status;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function update()
    {
        if (!$this->validate()) {
            return null;
        }

        $this->objUser->username = $this->username;
        $this->objUser->email = $this->email;
        $this->objUser->status = $this->status;
        if (!empty($this->password)) $this->objUser->setPassword($this->password);

        return $this->objUser->update() ? $this->objUser : null;
    }
}