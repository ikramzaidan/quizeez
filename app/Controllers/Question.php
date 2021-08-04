<?php namespace App\Controllers;

class Question extends BaseController
{   
	public function create($group_hash, $quiz_hash)
	{
        $data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
        $data['usrn']  = $user['username'];
		$data['group'] = $Group['id'];
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){

				$data['quiz_hash'] = $quiz_hash;
				echo view('dashboard/sidebar', $data);
				echo view('dashboard/content-question-create', $data);
				echo view('dashboard/footer', $data);
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}

    public function createNew($group_hash, $quiz_hash)
	{
        $data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
        $Quiz          = $this->db->table('quiz')->getWhere(['hash'=>$quiz_hash])->getRowArray();
        $data['usrn']  = $user['username'];
		$data['group'] = $Group['id'];
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){

				$field = [
                    'id_quiz'    => $Quiz['id'],
                    'question'   => $this->request->getVar('question'),
                    'option_1'   => $this->request->getVar('option_1'),
                    'option_2'   => $this->request->getVar('option_2'),
                    'option_3'   => $this->request->getVar('option_3'),
					'option_key' => $this->request->getVar('key')
                ];
        
                if($this->QuestionModel->save($field)){
                    return redirect()->to(base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash."/edit/");
                }else{
                    return redirect()->to('');
                }
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}

	function uploadImage($group_hash, $quiz_hash){
		$data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
        $Quiz          = $this->db->table('quiz')->getWhere(['hash'=>$quiz_hash])->getRowArray();
        $data['usrn']  = $user['username'];
		$data['group'] = $Group['id'];
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){

				$validated = $this->validate([
					'file' => [
						'uploaded[upload]',
						'mime_in[upload,image/jpg,image/jpeg,image/png]',
						'max_size[upload,4096]',
					],
				]);
				if($validated){
					$flPhoto = $this->request->getFile('upload');
					$flName  = $flPhoto->getRandomName();
					$writePath = 'uploads/';
					
					if($flPhoto->move($writePath, $flName)){
	
						$data = [
							"uploaded" => true,
							"url" => base_url('uploads/'.$flName)
						];
						return $this->response->setJSON($data);
					}
				}else{
					$data = [
						"uploaded" => false,
						"error" => [
							"messages" => $flPhoto
						]
					];
					return $this->response->setJSON($data);
				}
        
                if($this->QuestionModel->save($field)){
                    return redirect()->to('/login');
                }else{
                    return redirect()->to('');
                }
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}
}