<?php

namespace Bredi\LaravelAutodeploy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class LaravelAutodeployController extends Controller
{
    public function webhook(Request $request) {

		$input = $request->all();
			
		if ($request->isMethod('post')) {
			echo "Post"; 
			$branch = config('laravelautodeploy.branch');

			if (isset($input['ref']) and $input['ref'] == 'refs/heads/' . $branch) {
					\Log::info($input);
					// exec('cd ../ && git fetch --all && git reset --hard origin/' . $branch); //original
					// $commit_hash = shell_exec('cd ../ && git rev-parse --short HEAD'); //original
					$arrCommand = [];
					if (count(config('laravelautodeploy.commands.servidor')) > 0) {
							foreach(config('laravelautodeploy.commands.servidor') as $command) {
								
								$command = str_replace("{branch}", $branch, $command);
								
								$prefixo = "cd " . config('laravelautodeploy.folder_git');
								$command = $prefixo . " && " . $command;
								echo $command . "<br>";
								$arrCommand[] = $command;

								$shell = shell_exec($command);
								echo $shell . "<br>";
								$arrCommand[] = $shell;
							}

							\Log::info($arrCommand);
					}
			}

		} else {
			echo "Acesso ao Autodeploy.<br>";
			echo "Envie os dados como POST para funcionar o Autodeploy.";
		}
	}
}
