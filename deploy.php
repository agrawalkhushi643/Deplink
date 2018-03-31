<?php

namespace Deployer;

require 'recipe/laravel.php';

set('application', 'deplink/repository');
set('repository', 'https://github.com/deplink/repository');
set('ssh_multiplexing', false);

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', ['node_modules']);

host('deplink.org')
    ->user('travis')
    ->identityFile('~/.ssh/travis_rsa')
    ->set('deploy_path', '/var/www/repo.deplink.org');

task('deploy:npm', function () {
    if (has('previous_release')) {
        run('cp -R {{previous_release}}/node_modules {{release_path}}/node_modules');
    }

    run('cd {{release_path}} && npm install && npm run prod');
});

task('build', function () {
    run('cd {{release_path}} && build');
});

after('deploy:failed', 'deploy:unlock');
after('deploy:vendors', 'deploy:npm');

before('deploy:symlink', 'artisan:migrate');

