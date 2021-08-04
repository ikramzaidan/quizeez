<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionsModel extends Model
{
    protected $table = 'questions';
    protected $allowedFields = ['id','id_quiz','question','option_1','option_2','option_3','option_4','option_5','option_key'];
}

?>