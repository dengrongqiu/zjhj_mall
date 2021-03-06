<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/9/28
 * Time: 14:11
 */

namespace app\modules\api\models;


use app\models\TopicType;
use yii\data\Pagination;

class TopicTypeForm extends Model
{
    public $store_id;

    public $page;
    public $limit = 20;

    public function rules()
    {
        return [
            [['page'], 'integer'],
            [['page'], 'default', 'value' => 1],
        ];
    }

    public function search()
    {
        $query = TopicType::find()->where(['is_delete' => 0]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'page' => $this->page - 1, 'pageSize' => $this->limit]);

        $list = $query->orderBy('sort ASC')->limit($pagination->limit)->offset($pagination->offset)
            ->select('id,name')->asArray()->all();
        return [
            'code' => 0,
            'data' => [
                'list' => $list,
            ],
        ];

    }
}