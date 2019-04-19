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
    protected $name = 'deploy:push {commit?} {--to=}';

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
                $success = true;
                $prefixo = "cd " . config('laravelautodeploy.folder_git');
                $command = str_replace("{para}", $this->option('to'), $command);
                $command = str_replace("{de}", config('laravelautodeploy.deploy_de'), $command);
                $command = str_replace("{commit}", $commit, $command);
                
                $prefixo .= " && " . $command;

                $this->info($command);
                // $this->task('executando... ' . $command, function () {
                //     return true;
                // });

                $shell =  shell_exec($prefixo . " 2>&1");
                $needles = config('laravelautodeploy.errors_log');

                $t = preg_match_all( '/\\b(' . join( $needles, '|' ) . ')\\b/i', $shell, $m, PREG_OFFSET_CAPTURE );
                
                if ($t != 0) {
                    $this->error($shell);
                
                    $errors += 1;
                    $msg = "Aconteceu algum erro.";
                    $success = false;
                    
                    $this->task('command: ' . $command, function () use ($success) {
                        return $success;
                    });

                    break;
                }

                echo $shell;

                $this->task('command: ' . $command, function () use ($success) {
                    return $success;
                });
                
            }

            if (config('laravelautodeploy.desktop_notification')) {
                $notifier = NotifierFactory::create();
                $notification = (new Notification())->setTitle('Laravel Autodeploy');
                
                if ($errors == 0) {
                    $notification
                        ->setBody("Todos os processos foram concluidos! 😎")
                        ->setIcon(__DIR__ . "/../Resources/icons/icon-success.png");
                        
                } else {
                    $notification
                        ->setBody($msg . " 😱")
                        ->setIcon(__DIR__ . "/../Resources/icons/error.png");
                }
    
                $notifier->send($notification);
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
