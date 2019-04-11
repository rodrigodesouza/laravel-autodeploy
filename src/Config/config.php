<?php

return [
    'name' => 'LaravelAutodeploy',
    'branch' => env('AUTODEPLOY', 'production'),
    'deploy_de' => env('DEPLOY_DE', 'master'),
    'deploy_para' => env('DEPLOY_PARA', 'production'),
    'commands' => [
        'git' => [
            'git add . && git commit -m "{commit}"',
            'git pull origin {de}',
            'git push origin {de}',
            'git checkout {para} && git merge {de}',
            'git push origin {para}',
            'git checkout {de}'
        ]
    ],
    'folder_git' => base_path()
];
