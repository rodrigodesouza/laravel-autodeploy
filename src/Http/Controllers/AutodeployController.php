<?php

namespace Bredi\Autodeploy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AutodeployController extends Controller {
	public function webhook(Request $request) {

		$input = $request->all();

		if ($request->isMethod('post')) {
			\Log::info($input);
			// $repo_dir = '../pasta.git';
			// $web_root_dir = '../';
			// $git_bin_path = 'git';
			// $web_root_dir = '/home/sitebeta/www/logicomsite';
			if (isset($input['ref']) and $input['ref'] == 'refs/heads/production') {
				// exec('cd ../ && git init');
				exec('cd ../ && git fetch --all && git reset --hard origin/production');
				// \Log::info($a);
				$commit_hash = shell_exec('cd ../ && git rev-parse --short HEAD');
				\Log::info(array(" Deployed branch: producao Commit: " . $commit_hash));
			}

		} else {
			echo "Acesso ao Autodeploy.<br>";
			echo "Envie os dados como POST para funcionar o Autodeploy.";
		}
	}

}
