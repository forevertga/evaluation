<?php

namespace app\models;

use app\libs\Utils;
use CottaCush\Yii2\Date\DateUtils;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class BaseLOVModel
 * @package app\models
 */
class BaseLOVModel extends BaseModel
{
    /**
     * Convert the name value to UPPERCASE by default
     * @author Akinwunmi Taiwo <taiwo@cottacush.com>
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->hasAttribute('name')) {
            $this->name = ucwords($this->name);
        }

        return true;
    }
}
