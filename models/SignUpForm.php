<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'first_name', 'last_name', 'password'], 'required'],
        ];
    }
}
