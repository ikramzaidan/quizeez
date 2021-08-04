<?php namespace App\Controllers;

use App\Models\UsersModel;

class Signup extends BaseController
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
            return view('main/signup', $data);
        }
	}

    public function new()
    {
        $model = new UsersModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($pass = $this->request->getVar('password'), PASSWORD_DEFAULT),
            'name'     => $this->request->getVar('name'),
            'email'    => $this->request->getVar('email'),
            'type'     => $this->request->getVar('type')
        ];

        if($model->save($data)){
            return redirect()->to('/login');
        }else{
            return redirect()->to('');
        }
    }
}
