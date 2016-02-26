<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oc_category".
 *
 * @property integer $category_id
 * @property string $image
 * @property integer $parent_id
 * @property integer $top
 * @property integer $column
 * @property integer $sort_order
 * @property integer $status
 * @property string $date_added
 * @property string $date_modified
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'top', 'column', 'sort_order', 'status'], 'integer'],
            [['top', 'column', 'status', 'date_added', 'date_modified'], 'required'],
            [['date_added', 'date_modified'], 'safe'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'image' => 'Image',
            'parent_id' => 'Parent ID',
            'top' => 'Top',
            'column' => 'Column',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }

    public function getDescription()
    {
        return $this->hasOne(CategoryDescription::className(), ['category_id' => 'category_id']);
    }
}
