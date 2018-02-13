<?php

namespace common\components\db;

use common\components\Urlifier;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Class ReleazImageRecord
 * @package common\components\db
 *
 * @property string $imageInternal
 * @property string $imageExternal
 * @property string $imagePathInternal
 * @property string $imagePathExternal
 */
class ReleazImageRecord extends ReleazActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * Get the image path and name, return null if empty
     * @return string|null
     */
    public function getDisplayImage()
    {
        if (!empty($this->image)) {
            return file_exists($this->imageInternal) ? $this->imageExternal : null;
        }

        return null;
    }

    /**
     * Get the internal path to the image directory
     * @return string
     * @throws InvalidParamException
     */
    public function getImagePathInternal(): string
    {
        return Yii::getAlias(Yii::$app->params['uploadPathInternal']);
    }

    /**
     * Get the external path to the image directory
     * @return string
     */
    public function getImagePathExternal(): string
    {
        return Yii::$app->params['uploadPathExternal'];
    }

    /**
     * Get the internal path to the image
     * @return string
     */
    public function getImageInternal(): string
    {
        return "$this->imagePathInternal/$this->image";
    }

    /**
     * Get the external path to the image
     * @return string
     */
    public function getImageExternal(): string
    {
        return "$this->imagePathExternal/$this->image";
    }

    /**
     * If the model gets deleted we should also remove the file
     */
    public function afterDelete()
    {
        $this->deleteImage();

        parent::afterDelete();
    }

    /**
     * Delete the image
     */
    public function deleteImage()
    {
        if (!empty($this->image)) {
            if (file_exists($this->imageInternal)) {
                @unlink($this->imageInternal);
            }
            $this->image = null;
        }
    }

    /**
     * Check if we need to save the image
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if ($this->imageFile !== null) {
                // Delete the old image
                $this->deleteImage();

                // Check if the dir exists, otherwise create
                if (!is_dir($this->imagePathInternal)) {
                    FileHelper::createDirectory($this->imagePathInternal);
                }

                // Let's save the image
                $file_name = time() . '-' . Urlifier::urlify($this->imageFile->baseName) . '.' . $this->imageFile->extension;

                $this->imageFile->saveAs("$this->imagePathInternal/$file_name");
                $this->image = $file_name;
            }

            return true;
        }

        return false;
    }

}

