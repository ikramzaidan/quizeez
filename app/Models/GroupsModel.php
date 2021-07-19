<?php namespace App\Models;

use CodeIgniter\Model;

class GroupsModel extends Model
{
    protected $table = 'groups';
    protected $allowedFields = ['id','id_user','group_name','group_desc','group_code','group_pass'];

    function createGroup($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $data2 = [
            'id_user'  => $data['id_user'],
            'id_group' => $this->db->insertID()
        ];
        return $this->db->table('users_groups')->insert($data2);
    }

    function joinGroup($data)
    {
        $builder = $this->db->table('users_groups');
        return $this->db->table('users_groups')->insert($data);
    }
}

?>