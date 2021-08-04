<?php namespace App\Models;

use CodeIgniter\Model;

class AnswersModel extends Model
{
    protected $table = 'answers';
    protected $allowedFields = ['id','id_quiz','id_user','id_question','id_attempt','answer','status'];
}

?>