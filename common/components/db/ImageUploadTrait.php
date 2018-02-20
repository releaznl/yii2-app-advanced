<?php

namespace common\components\db;

use common\components\Urlifier;
use ReflectionClass;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 *
 * @property null|string $displayImage
 * @property string $imagePathExternal
 * @property string $imageInternal
 * @property string $imageExternal
 * @property string $imagePathInternal
 * @property string $image
 */
trait ImageUploadTrait
{
    /** @var UploadedFile */
    public $imageFile;
    /** @var bool property for a checkbox to delete the current image */
    public $deleteImage;
    /** @var string */
    public $imageAttribute = 'image';
    /** @var string */
    public $imageFileInputName = 'imageFile';

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['deleteImage'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'deleteImage' => Yii::t('common', 'delete_image'),
        ];
    }

    /**
     * @return bool
     */
    public function hasImage(): bool
    {
        return !empty($this->image) && file_exists($this->imageInternal);
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!empty($this->{$this->imageAttribute})) {
            return $this->{$this->imageAttribute};
        }

        return '';
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->{$this->imageAttribute} = $image;
    }

    /**
     * Get the image path and name, return null if empty
     * @return string|null
     */
    public function getDisplayImage()
    {
        if (!empty($this->image)) {
            return $this->hasImage() ? $this->imageExternal : null;
        }

        return null;
    }

    /**
     * Get the internal path to the image directory
     * @return string
     * @throws \ReflectionException
     * @throws \yii\base\InvalidArgumentException
     */
    public function getImagePathInternal(): string
    {
        $modelClassName = (new ReflectionClass($this))->getShortName();

        // convert model class name from CamelCase to camel-case
        $modelClassName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $modelClassName));

        return Yii::getAlias('@web-folder') . '/uploads/' . $modelClassName;
    }

    /**
     * Get the external path to the image directory
     * @return string
     * @throws \ReflectionException
     * @throws \yii\base\InvalidArgumentException
     */
    public function getImagePathExternal(): string
    {
        $modelClassName = (new ReflectionClass($this))->getShortName();

        // convert model class name from CamelCase to camel-case
        $modelClassName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $modelClassName));

        return '/uploads/' . $modelClassName;
    }

    /**
     * Get the internal path to the image
     * @return string
     * @throws \ReflectionException
     */
    public function getImageInternal(): string
    {
        $image = $this->image;

        return "$this->imagePathInternal/$image";
    }

    /**
     * Get the external path to the image
     * @return string
     * @throws \ReflectionException
     */
    public function getImageExternal(): string
    {
        $image = $this->image;

        return "$this->imagePathExternal/$image";
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

            $this->image = '';
        }
    }

    /**
     * @return boolean
     */
    public function beforeValidate(): bool
    {
        $this->imageFile = UploadedFile::getInstance($this, $this->imageFileInputName);

        return parent::beforeValidate();
    }

    /**
     * Check if we need to save the image
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->deleteImage) {
                $this->deleteImage();
            }

            if ($this->imageFile !== null) {
                // delete the old image
                $this->deleteImage();

                // check if the dir exists, otherwise create
                if (!is_dir($this->imagePathInternal)) {
                    FileHelper::createDirectory($this->imagePathInternal);
                }

                // save the image
                $fileName = time() . '-' . Urlifier::urlify($this->imageFile->baseName) . '.' . $this->imageFile->extension;
                $this->image = $fileName;

                return $this->imageFile->saveAs("$this->imagePathInternal/$fileName");
            }

            return true;
        }

        return false;
    }
}
