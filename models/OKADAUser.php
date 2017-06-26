<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $display_name
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login_time
 */

class OKADAUser extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'password'], 'required'],
            [['created_at', 'updated_at', 'last_login_time'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['display_name', 'first_name', 'last_name'], 'string', 'max' => 200],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'display_name' => 'Display Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_time' => 'Last Login Time',
            'first_name' => 'FirstName',
            'last_name' => 'LastName',
        ];
    }

    /**
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
