<?php

namespace app\models;

use Yii;

use gilek\gtreetable\models\TreeModel;

/**
 * This is the model class for table "oc_area".
 *
 * @property integer $area_id
 * @property string $area_name
 * @property integer $parent_id
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property string $date_added
 * @property string $date_modified
 */
class Area extends TreeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'level', 'lft', 'rgt', 'root'], 'integer'],
            [['date_added', 'date_modified'], 'safe'],
            [['area_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'Area ID',
            'area_name' => 'Area Name',
            'parent_id' => 'Parent ID',
            'level' => 'Level',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'root' => 'Root',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AreaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AreaQuery(get_called_class());
    }

    public function fields()
    {
        return [
            'id' => 'area_id',
            'name' => 'area_name'
        ];
    }
}
