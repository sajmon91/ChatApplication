<?php 

class AjaxGetGroupChat extends Controller
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

      $groupId = (int) filter_var($decoded->groupId, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      // get all chats
      $chats = $chatModel->getGroupChats($groupId);

      // load view
      $this->view('chats/chat', $chats);
    }

	}

} // end class
