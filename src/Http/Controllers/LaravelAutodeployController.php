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
			
			// $repo_dir = '../pasta.git';
			// $web_root_dir = '../';
			// $git_bin_path = 'git';
			// $web_root_dir = '/home/sitebeta/www/logicomsite';
			$ramo = config('laravelautodeploy.branch');
			if (isset($input['ref']) and $input['ref'] == 'refs/heads/' . $ramo) {
				\Log::info($input);
				// exec('cd ../ && git fetch --all && git reset --hard origin/' . $ramo);
				// \Log::info($a);
				$commit_hash = shell_exec('cd ../ && git rev-parse --short HEAD');
				\Log::info(array(" Deployed branch: {$ramo} Commit: " . $commit_hash));
			}

		} else {
			echo "Acesso ao Autodeploy.<br>";
			echo "Envie os dados como POST para funcionar o Autodeploy.";
		}
	}
}
