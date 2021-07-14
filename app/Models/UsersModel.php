<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id','username','password','name','email','type','time_created','time_latest'];
}

?>