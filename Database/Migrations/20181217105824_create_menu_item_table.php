<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Database\Migrations;

class Migration_create_menu_item_table extends \BasicApp\Core\Migration
{

    public $tableName = 'menu_item';

    public $menuTableName = 'menu';

    public function up()
    {
        $this->forge->addField([
            'item_id' => $this->primaryKey()->toArray(),
            'item_created_at' => $this->created()->toArray(),
            'item_updated_at' => $this->updated()->toArray(),
            'item_menu_id' => $this->foreignKey()->toArray(),
            'item_name' => $this->string()->toArray(),
            'item_url' => $this->string()->toArray(),
            'item_sort' => $this->sort()->toArray(),
            'item_enabled' => $this->boolean()->toArray(),
            'item_uid' => $this->string()->toArray()
        ]);

        $this->forge->addKey('item_id', true);

        $this->forge->addKey('item_enabled', false, false);

        $this->forge->addKey(['item_uid', 'item_menu_id'], false, true);

        $this->forge->addForeignKey('item_menu_id', $this->menuTableName, 'menu_id', 'RESTRICT', 'RESTRICT');

        $this->forge->createTable($this->tableName, false);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }

}