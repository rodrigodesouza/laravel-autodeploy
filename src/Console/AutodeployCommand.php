<?php

namespace Bredi\LaravelAutodeploy\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AutodeployCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'deploy:push {example?} {--to=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $commit = $this->argument('commit');

        if (!isset($commit) || !$commit) {
            $commit = $this->ask('Qual a descrição do seu commit?');
        }

        if (count(config('laravelautodeploy.commands.git')) > 0) {

            foreach(config('laravelautodeploy.commands.git') as $command) {
                $prefixo = "cd " . config('laravelautodeploy.folder_git');
                $command = str_replace("{para}", $this->option('to'), $command);
                $command = str_replace("{de}", config('laravelautodeploy.deploy_de'), $command);
                $command = str_replace("{commit}", $commit, $command);
                
                $prefixo .= " && " . $command;
                
                $this->info('command: ' . $command . " (✓)");
                
                $shell =  shell_exec($prefixo);

                echo $shell;

                if (strstr($shell, 'CONFLICT')) {
                    $this->error('Woops! Corrija o conflito e tente novamente. (✖)');
                    break;
                }

                if (strstr($shell, 'rejected')) {
                    $this->error('Woops! Aconteceu algum erro. (✖)');
                    break;
                }
    
            }
        }
        
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['commit', InputArgument::OPTIONAL, 'A descricão do commit.'],
            // ['commit', InputArgument::REQUIRED, 'A descricão do commit.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['to', null, InputOption::VALUE_OPTIONAL, 'An example option.', config('laravelautodeploy.deploy_para')],
        ];
    }
}
