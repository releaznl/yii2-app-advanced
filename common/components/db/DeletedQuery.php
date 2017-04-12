<?php
// file CommentQuery.php
namespace common\components\db;

use yii\db\ActiveQuery;

class DeletedQuery extends ActiveQuery
{
    private $table_name;

    public function init()
    {
        $this->andOnCondition([$this->table_name . '.deleted_at' => null]);
        parent::init();
    }

    public function __construct($table, $config = [])
    {
        $this->table_name = $table;
        parent::__construct($config);
    }
}
