<?php namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';
    protected $allowedFields = ['id','id_user','id_group','hash','name','description','duration','time_open','time_close'];

    function createQuiz($data)
    {
        $builder      = $this->db->table($this->table);
        $data['hash'] = crypt($this->db->insertID().$data['id_user'].$data['id_group'].$this->db->insertID(), md5($data['name']));
        return  $builder->insert($data);
    }

}

?>