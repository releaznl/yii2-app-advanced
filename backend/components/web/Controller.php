<?php

namespace backend\components\web;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class Controller
 * @package backend\components\web
 */
class Controller extends \yii\web\Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
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
