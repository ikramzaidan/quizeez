<?php namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
	public function index()
	{   
        $Session = session();
        $log     = $Session->sess_log;
        if($log == 1){
            return redirect()->to('/main');
        }else{
            $data = array(
                'assets' => "assets"
            );
            return view('main/login', $data);
        }
	}

    function auth()
    {
        $Model = new UsersModel();
        $Session = session();
        $usrn = $this->request->getVar('username');
        $pass = $this->request->getVar('password');

        $User = $Model->where('username', $usrn)->first();

        if($User){
            $id   = $User['id'];
            $usrn = $User['username'];
            $pasw = $User['password'];
            if($pass == $pasw){
                $session_data = [
                    'sess_token'    => md5($id,$usrn),
                    'sess_user'     => $User['username'],
                    'sess_log'      => '1',
                ];

                $Session->set($session_data);
                return redirect()->to('/');
            }else{
                $Session->setFlashdata('msg','Password Salah!');
                return redirect()->to('/login');
            }
        }else{
            $Session->setFlashdata('msg','Username atau Password Salah!');
            return redirect()->to('/login');
        }
    }
}
