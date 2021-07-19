<?php namespace App\Controllers;

class Quiz extends BaseController
{
    public function index($group_hash,$quiz_hash)
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
				echo view('dashboard/content-quiz', $data);
				echo view('dashboard/footer', $data);
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}
}