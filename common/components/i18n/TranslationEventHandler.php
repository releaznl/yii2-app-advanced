<?php

namespace common\components\i18n;

use yii\i18n\MissingTranslationEvent;

/**
 * Display an error if the user has forgotten the translation
 * Class TranslationEventHandler
 * @package common\components\i18n
 */
class TranslationEventHandler
{
    /**
     * @param MissingTranslationEvent $event
     */
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        $event->translatedMessage = "!!!MISSING: {$event->category}.{$event->message} FOR LANGUAGE {$event->language} !!!";
    }
}