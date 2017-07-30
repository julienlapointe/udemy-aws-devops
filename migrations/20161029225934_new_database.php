<?php

// __ROOT__ is the project's root folder (not "public", "templates" or another sub-folder)
// define('__ROOT__', dirname(dirname(__FILE__))); 
// require(__ROOT__ . '/.env');

use Phinx\Migration\AbstractMigration;

class NewDatabase extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('my_quotes', array('id'=>false, 'primary_key'=>array('quote_id')));
        $table->addColumn('quote_id', 'string', array('limit'=>32))
              ->addColumn('created', 'datetime')
              ->addColumn('category', 'string', array('limit'=>32))
              ->addColumn('json_blurb', 'text')
              ->create();
    }
    
    public function down()
    {
        $this->dropTable('my_quotes');

    }
}
