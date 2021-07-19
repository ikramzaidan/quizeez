<?php namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';
    protected $allowedFields = ['id','id_user','id_group','hash','name','description','duration'];

    function createQuiz($data)
    {
        $builder      = $this->db->table($this->table);
        $data['hash'] = crypt($this->db->insertID().$data['id_user'].$data['id_group'], md5($data['id_group']));
        return  $builder->insert($data);
    }

    function joinGroup($data)
    {
        $builder = $this->db->table('users_groups');
        return $this->db->table('users_groups')->insert($data);
    }
}

?>