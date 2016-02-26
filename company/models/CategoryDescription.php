<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_category_description".
 *
 * @property integer $category_id
 * @property integer $language_id
 * @property string $name
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 */
class CategoryDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_category_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'language_id', 'name', 'description', 'meta_title', 'meta_description', 'meta_keyword'], 'required'],
            [['category_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'language_id' => 'Language ID',
            'name' => 'Name',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
    }
}
