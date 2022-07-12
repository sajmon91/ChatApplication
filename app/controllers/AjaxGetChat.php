<?php 

class AjaxGetChat extends Controller
{
	public function index()
	{
		if (!isLoggedIn()) {
			redirect('users/login');
		}

    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';


    if($contentType === "application/json"){

      $chatModel = $this->model('Chat');

      $content = trim(file_get_contents('php://input'));

      $decoded = json_decode($content);

      $userTo = (int) filter_var($decoded->userTo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $userFrom = $_SESSION['user_id'];

      // get all chats
      $chats = $chatModel->getChats($userFrom, $userTo);

      // load view
      $this->view('chats/chat', $chats);
    }

	}

} // end class
