<?php namespace App\Controllers;

class Answer extends BaseController
{
    function mark($group_hash, $quiz_hash, $id_question){
        $data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
        $data['usrn']  = $user['username'];
		$data['group'] = $Group['id'];
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
            $VerifMark   = $this->db->table('questions')->where('id_quiz', $VerifQuiz['id'])->getWhere(['id'=>$id_question])->getRowArray();
			if($VerifUser and $VerifQuiz){
                if($VerifMark){
                    $Marked = $this->db->table('answers')->where('id_user', $user['id'])->getWhere(['id_question'=>$id_question])->getRowArray();
                    if(!$Marked){
                        $field = [
                            'id_quiz'    => $VerifQuiz['id'],
                            'id_user'    => $user['id'],
                            'id_question'=> $id_question,
                            'answer'     => $this->request->getVar('option')
                        ];
                        
                        $save = $this->AnswerModel->insert($field);
                        $data = [
                                'success' => true,
                                'data' => $save
                        ];
        
                        return $this->response->setJSON($data);
                    }else{
                        $field = $this->request->getVar('option');
                        $builder = $this->db->table('answers');
                        $builder->set('answer', $field);
                        $builder->where('id_user', $user['id']);
                        $builder->where('id_quiz', $VerifQuiz['id']);
                        $builder->where('id_question', $id_question);
                        $update = $builder->update();

                        $data = [
                                'success' => true,
                                'data' => $update
                        ];
        
                        return $this->response->setJSON($data);
                    }
                }                
            }else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to(base_url());
		}
    }
}