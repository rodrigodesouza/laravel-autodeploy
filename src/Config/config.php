<?php

return [
    'name' => 'LaravelAutodeploy',
    'branch' => env('AUTODEPLOY', 'production'),
    'deploy_de' => env('DEPLOY_DE', 'master'),
    'deploy_para' => env('DEPLOY_PARA', 'production'),
    'errors_log' => [
        'CONFLICT',
        'error: '
    ],
    'commands' => [
        'local' => [
            'git add . && git commit -m "{commit}"',
            'git pull origin {de}',
            'git push origin {de}',
            'git checkout {para} && git merge {de}',
            'git add . && git commit -m "{commit}"',
            'git push origin {para}',
            'git checkout {de}'
        ],
        'servidor' => [
            'git fetch --all && git reset --hard origin/{branch}',
        ]
    ],
    'folder_git' => null,               // base_path(),
    'desktop_notification' => true
];
