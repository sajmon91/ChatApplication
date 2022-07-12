<?php 

class AjaxInsertGroupChat extends Controller
{
	public function index()
	{
		if (!isLoggedIn()) {
			redirect('users/login');
		}

		if (isset($_POST['groupId']) && isset($_POST['message'])) {

			$chatModel = $this->model('Chat');

			$userSent = (int)$_SESSION['user_id'];

			$groupId = (int)trim(filter_input(INPUT_POST, 'groupId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			$msg = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

			$chatModel->insertGroupMessage($userSent, $groupId, $msg);
		}

	}

} // end class
