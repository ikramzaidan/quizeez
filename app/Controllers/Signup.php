<?php namespace App\Controllers;

use App\Models\UsersModel;

class Signup extends BaseController
{
	public function index()
	{
		return view('main/signup');
	}

    public function new()
    {
        $model = new UsersModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'type' => $this->request->getVar('type')
        ];

        if($model->save($data)){
            return redirect()->to('/login');
        }else{
            return redirect()->to('');
        }
    }
}
