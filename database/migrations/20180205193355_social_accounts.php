<?php

use Phinx\Migration\AbstractMigration;

class SocialAccounts extends AbstractMigration
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
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function change()
    {
        $this->table('social_accounts')
            ->addColumn('user_id', 'integer', ['comment' => 'Internal user id.'])
            ->addForeignKey('user_id', 'users')
            ->addColumn('account_id', 'string', ['comment' => 'Unique social account id.'])
            ->addColumn('provider', 'string', ['limit' => 64, 'comment' => 'Provider short name, see "config.auth.oauth2.providers" keys.'])
            ->create();
    }
}
