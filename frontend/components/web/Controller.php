<?php

namespace frontend\components\web;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class Controller
 * @package frontend\components\web
 */
class Controller extends \yii\web\Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

}
