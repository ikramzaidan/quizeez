<?php namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quiz';
    protected $allowedFields = ['id','id_user','id_group','name','description','duration'];

    function createQuiz($data)
    {
        $builder = $this->db->table($this->table);
        return  $builder->insert($data);
    }

    function joinGroup($data)
    {
        $builder = $this->db->table('users_groups');
        return $this->db->table('users_groups')->insert($data);
    }
}

?>