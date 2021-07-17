<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GroupsModel;

class Group extends BaseController
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

			return view('dashboard/content-createGroup', $data);
		}else{
			return redirect()->to('login');
		}
	}

    public function create()
	{
		$UserModel    = new UsersModel();
        $GroupModel   = new GroupsModel();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$User    = $UserModel->where('username', $usr)->first();

			$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			$randomCode = substr(str_shuffle($permitted_chars), 0, 5);

            $data = [
                'id_user'    => $User['id'],
                'group_name' => $this->request->getVar('name'),
                'group_desc' => $this->request->getVar('desc'),
				'group_code' => $randomCode
            ];
            if($GroupModel->saveGroup($data)){
                return redirect()->to('/main');
            }else{
                return redirect()->to('');
            }

		}else{
			return redirect()->to('login');
		}

	}
}