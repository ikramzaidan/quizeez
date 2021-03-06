<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\GroupsModel;
use App\Models\QuizModel;
use App\Models\QuestionsModel;
use App\Models\AnswersModel;
use App\Models\AttemptsModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->db         = \Config\Database::connect();
		$this->UserModel = new UsersModel();
		$this->GroupModel = new GroupsModel();
		$this->QuizModel = new UsersModel();
		$this->AnswerModel = new AnswersModel();
		$this->QuestionModel = new QuestionsModel();
		$this->AttemptModel = new AttemptsModel();
		$this->Session    = session();
		$log      = $this->Session->sess_log;
		$usr      = $this->Session->sess_user;
		$this->data      = [
			'assets'    => "assets",
			'usr'       => $usr,
			'log'       => $log
		];
	}

}
