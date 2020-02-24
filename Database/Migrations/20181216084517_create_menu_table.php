<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Menu\Database\Migrations;

class Migration_create_menu_table extends \BasicApp\Core\Migration
{

    public $tableName = 'menu';

    public function up()
    {
        $this->forge->addField([
            'menu_id' => $this->primaryKey()->toArray(),
            'menu_created_at' => $this->created()->toArray(),
            'menu_updated_at' => $this->updated()->toArray(),
            'menu_uid' => $this->string()->unique()->toArray(),
            'menu_name' => $this->string()->toArray()
        ]);

        $this->forge->addKey('menu_id', true);

        $this->forge->createTable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }

}