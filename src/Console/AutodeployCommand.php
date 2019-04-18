<?php

namespace Bredi\LaravelAutodeploy\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

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
    protected $description = 'Faz o commit no branch de trabalho e no branch de produção. Executa comandos Shell.';

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

        if (count(config('laravelautodeploy.commands.local')) > 0) {

            $errors = 0;
            $msg    = "";

            foreach(config('laravelautodeploy.commands.local') as $command) {
                $prefixo = "cd " . config('laravelautodeploy.folder_git');
                $command = str_replace("{para}", $this->option('to'), $command);
                $command = str_replace("{de}", config('laravelautodeploy.deploy_de'), $command);
                $command = str_replace("{commit}", $commit, $command);
                
                $prefixo .= " && " . $command;
                
                $shell =  shell_exec($prefixo);
                // $shell =  "CONFLICT";

                echo $shell;

                if (strstr($shell, 'CONFLICT')) {
                    // $this->error('Woops! Corrija o conflito e tente novamente. (✖)');
                    $this->task('Woops! Corrija o conflito e tente novamente.', function () {
                        return false;
                    });
                    $errors += 1;
                    $msg = "Corrija o conflito e tente novamente. (✖)";
                    break;
                }

                if (strstr($shell, 'rejected')) {
                    // $this->error('Woops! Aconteceu algum erro. (✖)');
                    $this->task('Woops! Aconteceu algum erro.', function () {
                        return false;
                    });
                    $errors += 1;
                    $msg = "Aconteceu algum erro. (✖)";
                    break;
                }
                
                // $this->info('command: ' . $command . " (✓)");

                $this->task('command: ' . $command, function () {
                    return true;
                });
                
            }

            // Create a Notifier
            $notifier = NotifierFactory::create();

            // Create your notification
            $notification = (new Notification())->setTitle('Laravel Autodeploy');
            
            if ($errors == 0) {
                // $this->notify("Oba!", "Todos os processos foram concluidos!");
                $notification->setBody("Todos os processos foram concluidos!");
            } else {
                // $this->notify("Woops!", $msg,  __DIR__ . "/../Resources/icons/error.png");
                //, __DIR__ . "/../Resources/icons/error.png"
                $notification->setBody($msg);
            }

            $notifier->send($notification);
            
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
