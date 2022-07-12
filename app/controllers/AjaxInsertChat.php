<?php 

class AjaxInsertChat extends Controller
{
	public function index()
	{
		if (!isLoggedIn()) {
			redirect('users/login');
		}

		if (isset($_POST['userTo']) && isset($_POST['message'])) {

			$chatModel = $this->model('Chat');

			$userFrom = $_SESSION['user_id'];

			$userTo = (int)trim(filter_input(INPUT_POST, 'userTo', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			$msg = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

			$chatModel->insertMessage($userFrom, $userTo, $msg);
		}

	}

} // end class
