<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\UserData;
use backend\models\Employee;

/**
 * Signup form
 */
class RegisterEmployee extends Model
{
    public $username;
    public $email;
    public $password;

    public $role;
    public $fName;
    public $surname;
    public $gender;
    public $phone;
    public $nif;
    public $birthdate;

    public $salary;
    public $airportID;


    public function rules()
    {
        return [
            ['fName', 'trim'],
            ['fName', 'required'],
            ['fName', 'string', 'min' => 2, 'max' => 25],

            ['surname', 'trim'],
            ['surname', 'required'],
            ['surname', 'string', 'min' => 2, 'max' => 25],

            ['gender', 'required'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'min' => 9, 'max' => 9],

            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9],

            ['birthdate', 'trim'],
            ['birthdate', 'required'],
            ['birthdate', 'string', 'min' => 10, 'max' => 10],

            ['salary', 'trim'],
            ['salary', 'required'],
            ['salary', 'integer'],

            ['role', 'required'],
            ['role', 'string', 'min' => 2, 'max' => 255],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $userData = new UserData();
        $employee = new Employee();

        // tabela USER
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = 10;

        $user->save();

        // tabela USERDATA
        $userData->user_id = $user->getId();
        $userData->fName = $this->fName;
        $userData->surname = $this->surname;
        $userData->gender = $this->gender;
        $userData->phone = $this->phone;
        $userData->nif = $this->nif;
        $userData->birthdate = $this->birthdate;

        $userData->save();

        // tabela EMPLOYEE
        $employee->user_id = $user->getId();
        $employee->salary = $this->salary;

        $employee->save();

        // RBAC
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        $auth->assign($role, $user->getId());


        return ($employee->save() && $user->save() && $userData->save());
    }
}
