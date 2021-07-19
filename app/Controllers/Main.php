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
				'log'       => $log
			];

			echo view('dashboard/sidebar', $data);
			echo view('dashboard/content-home', $data);
			echo view('dashboard/footer', $data);
		}else{
			return redirect()->to('login');
		}

	}

	public function group($group_hash)
	{
		$db       = \Config\Database::connect();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$User    = new UsersModel();
			$Group   = $db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
			if($Group){
				$user    = $User->where('username', $usr)->first();
				$Verif   = $db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
				if($Verif){
					$data    = 
					[
						'assets'    => "assets",
						'usrn'      => $user['username'],
						'group'     => $Group['id'],
						'group_hash'=> $group_hash,
						'log'       => $log
					];
					echo view('dashboard/sidebar', $data);
					echo view('dashboard/content-group', $data);
					echo view('dashboard/footer', $data);
					}
				else{
					return redirect()->to('/');
				}
			}else{
				return redirect()->to('/');
			}
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
