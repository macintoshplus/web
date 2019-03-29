<?php


use Phinx\Migration\AbstractMigration;

class AjoutConfig extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $sql = <<<SQL
create table `afup_configuration`
(
	`cle` varchar(50) null,
	`valeur` text null,
	constraint `afup_contiguration_pk`
		primary key (`cle`)
);        
SQL;
        $this->execute($sql);
    }

    public function down()
    {
        $sql = <<<SQL
drop table afup_configuration;        
SQL;
        $this->execute($sql);
    }
}
