<?php namespace App\Models;

use CodeIgniter\Model;

class AttemptsModel extends Model
{
    protected $table = 'attempts';
    protected $allowedFields = ['id','id_user','id_quiz','time_start','time_finish','correct','score'];

    function attemptStart($data)
    {
        $builder = $this->db->table($this->table);
        return  $builder->insert($data);
    }

    function attemptFinish($id, $data)
    {
        $builder = $this->db->table($this->table);
        return  $builder->where('id', $id)->set($data)->update();
    }
}

?>