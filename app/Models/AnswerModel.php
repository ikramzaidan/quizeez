<?php namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table = 'answers';
    protected $allowedFields = ['id','id_quiz','id_user','id_question','answer'];
}

?>