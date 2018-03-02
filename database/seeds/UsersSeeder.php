<?php

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $security = new Phalcon\Security();

        $data = [[
            'mail' => 'support@deplink.org',
            'first_name' => 'Wojciech',
            'last_name' => 'Mleczek',
            'password' => $security->hash('secret'),
        ]];

        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
