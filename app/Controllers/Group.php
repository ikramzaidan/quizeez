<?php namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GroupsModel;
use App\Models\QuizModel;

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

	public function member($group_hash)
	{
		$db      = \Config\Database::connect();
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

					return view('dashboard/content-group-member', $data);
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
            if($GroupModel->createGroup($data)){
                return redirect()->to('/main');
            }else{
                return redirect()->to('');
            }

		}else{
			return redirect()->to('login');
		}

	}

	public function join()
	{
		$db      = \Config\Database::connect();
		$UserModel    = new UsersModel();
        $GroupModel   = new GroupsModel();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$User      = $UserModel->where('username', $usr)->first();
			$groupCode = $this->request->getVar('group_code');
			$Group     = $db->table('groups')->getWhere(['group_code'=>$groupCode])->getRowArray();
			if($Group){
				$data = [
					'id_user'  => $User['id'],
					'id_group' => $Group['id']
				];
				if($GroupModel->joinGroup($data)){
					return redirect()->to('/main');
				}else{
					return redirect()->to('');
				}	
			}
		}else{
			return redirect()->to('login');
		}
	}

	public function create_quiz($group_hash)
	{
		$db      = \Config\Database::connect();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$User    = new UsersModel();
			$Group   = $db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
			if($Group){
				$user    = $User->where('username', $usr)->first();
				$Verif   = $db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
				if($Verif['level'] == 1){
					$data    = 
					[
						'assets'    => "assets",
						'usrn'      => $user['username'],
						'group'     => $Group['id'],
						'group_hash'=> $group_hash,
						'log'       => $log
					];

					echo view('dashboard/sidebar', $data);
					echo view('dashboard/content-quiz-create', $data);
					echo view('dashboard/footer', $data);
					}
				else{
					return redirect()->to('/');
				}
			}else{
				return redirect()->to('/');
			}
		}else{
			return redirect()->to(base_url('/login'));
		}
	}

	public function create_quiz_insert($group_hash)
	{
		$db      = \Config\Database::connect();
		$Session  = session();
		$log      = $Session->sess_log;
		$usr      = $Session->sess_user;
		if($log == 1){
			$User    = new UsersModel();
			$Quiz    = new QuizModel();
			$Group   = $db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
			if($Group){
				$user    = $User->where('username', $usr)->first();
				$Verif   = $db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
				if($Verif['level'] == 1){
					$titl = $this->request->getVar('title');
					if(isset($titl)){
						$data = [
							'id_group'   => $Group['id'],
							'id_user'    => $user['id'],
							'name'       => $titl,
							'description'=> $this->request->getVar('desc'),
							'duration'   => $this->request->getVar('duration'),
						];
						if($Quiz->createQuiz($data)){
							return redirect()->to('/main');
						}else{
							return redirect()->to('/group');
						}
					}
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
}