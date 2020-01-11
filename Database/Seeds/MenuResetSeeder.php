<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Block\Database\Seeds;

class MenuResetSeeder extends \BasicApp\Core\Seeder
{

    public function run()
    {
        $this->disableForeignKeys();

        $this->db->table('menu_item')->truncate();

        $this->db->table('menu')->truncate();

        $this->enableForeignKeys();
    }

}