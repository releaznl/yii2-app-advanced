<?php

namespace common\components\grid;

use Yii;
use yii\base\InvalidParamException;

/**
 * Class TotalColumn
 * @package common\components\grid
 */
class TotalColumn
{
    /**
     * Calculates the total of the specified GridView column
     * @param $provider
     * @param $field_name
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws InvalidParamException
     */
    public static function pageTotal($provider, $field_name)
    {
        $total = 0;
        foreach ($provider as $item) {
            $total += $item[$field_name];
        }
        return Yii::$app->formatter->asCurrency($total);
    }
}