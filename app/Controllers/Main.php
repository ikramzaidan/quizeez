<?php namespace App\Controllers;

use App\Models\UsersModel;

class Main extends BaseController
{
	public function index()
	{
		$Model    = new UsersModel();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$user    = $Model->where('username', $usr)->first();
			$data    = 
			[
				'assets'    => "assets",
				'usrn'      => $user['username'],
				'log'       => $log,
			];

			return view('dashboard/sidebar', $data);
		}else{
			return redirect()->to('login');
		}

	}
	public function logout()
	{
		$Session = session();
		$log     = $Session->sess_log;
		if($log == 1){
			$Session->destroy();
			return redirect()->to('/login');
		}else{
			return redirect()->to('/login');
		}
	}
}
