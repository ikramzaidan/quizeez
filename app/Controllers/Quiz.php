<?php namespace App\Controllers;

class Quiz extends BaseController
{
    public function index($group_hash, $quiz_hash)
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

	public function edit($group_hash, $quiz_hash)
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
				echo view('dashboard/content-quiz-edit', $data);
				echo view('dashboard/footer', $data);
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}

	function attemptStart($group_hash, $quiz_hash){
		$data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){
				$AttemptNum = $this->db->table('attempts')->where('id_quiz', $VerifQuiz['id'])->where('id_user', $user['id'])->countAllResults();
				if($AttemptNum == 0){
					date_default_timezone_set("Asia/Jakarta");
					$now = time();
					$duration = $now + ($VerifQuiz['duration'] * 60);
					$field = [
						'id_user' => $user['id'],
						'id_quiz' => $VerifQuiz['id'],
						'time_start' => $now,
						'status' => 1
					];
					$this->AttemptModel->attemptStart($field);
					$id_attempt = $this->db->insertID();
					return redirect()->to(base_url()."/group/".$group_hash."/quiz/".$quiz_hash."/attempt/".$id_attempt);
				}else{
					$Attempt = $this->db->table('attempts')->where('id_quiz', $VerifQuiz['id'])->orderBy('id', 'DESC')
								->getWhere(['id_user' => $user['id']], 1)->getRowArray();
					if($Attempt['status'] == 1){
						return redirect()->to(base_url()."/group/".$group_hash."/quiz/".$quiz_hash."/attempt/".$Attempt['id']);
					}elseif($Attempt['status'] == 2){
						return redirect()->to(base_url()."/group/".$group_hash."/quiz/".$quiz_hash);
					}
				}
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to(base_url());
		}
	}

	public function attempt($group_hash, $quiz_hash, $id_attempt)
	{
        $data          = $this->data;
		$user          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
        $data['usrn']  = $user['username'];
		$data['group'] = $Group['id'];
		$data['id_attempt'] = $id_attempt;
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$user['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){

				$data['quiz_hash'] = $quiz_hash;
				$data['attempt_data'] = $this->db->table('attempts')->where('id_quiz', $VerifQuiz['id'])->getWhere(['id_user'=>$user['id']])
										->getRowArray();
				$data['duration'] = $VerifQuiz['duration'];
				$data['time_open'] = $VerifQuiz['time_open'];
				$data['time_close'] = $VerifQuiz['time_close'];
				echo view('dashboard/sidebar', $data);
				echo view('dashboard/content-quiz-attempt', $data);
				echo view('dashboard/footer', $data);
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to('/');
		}
	}

	function attemptFinish($group_hash, $quiz_hash, $id_attempt){
		$data          = $this->data;
		$User          = $this->UserModel->where('username', $this->Session->sess_user)->first();
		$Group         = $this->db->table('groups')->getWhere(['group_code'=>$group_hash])->getRowArray();
		if($Group){
			$VerifUser   = $this->db->table('users_groups')->where('id_group', $Group['id'])->getWhere(['id_user'=>$User['id']])->getRowArray();
			$VerifQuiz   = $this->db->table('quiz')->where('hash', $quiz_hash)->getWhere(['id_group'=>$Group['id']])->getRowArray();
			if($VerifUser and $VerifQuiz){
				$Attempt = $this->db->table('attempts')->where('id_user', $User['id'])->getWhere(['id' => $id_attempt], 1)->getRowArray();
				if($Attempt['status'] == 1){
					date_default_timezone_set("Asia/Jakarta");
					$now = time();

					$corrcAs = $this->db->table('answers')->where('id_attempt', $id_attempt)->where('status', 1)->countAllResults();
					$totalQs = $this->db->table('questions')->where('id_quiz', $VerifQuiz['id'])->countAllResults();
					$scoreAt = $corrcAs;
					if($corrcAs == 0 or $totalQs == 0){$score = 0;}else{$score = round(100/$totalQs*$corrcAs, 2);}
					$field = [
						'time_finish' => $now,
						'correct' => $corrcAs,
						'score' => $score,
						'status' => 2
					];
					$this->AttemptModel->attemptFinish($id_attempt, $field);
					return redirect()->to(base_url()."/group/".$group_hash."/quiz/". $quiz_hash);
				}else{
					return redirect()->to(base_url()."/group/".$group_hash."/quiz/". $quiz_hash);
				}
			}else{
				return redirect()->to(base_url());
			}
		}else{
			return redirect()->to(base_url());
		}
	}
}