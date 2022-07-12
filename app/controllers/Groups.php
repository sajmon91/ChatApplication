<?php 

class Groups extends Controller
{
	public function __construct() {
		if (!isLoggedIn()) {
			redirect('users/login');
		}

		$this->userModel = $this->model('User');
		$this->groupModel = $this->model('Group');
	}

//////////////////////////////////////////////////////////////////////////////////////////

	public function index($id)
	{
		if ($this->groupModel->checkForGroupOwner($id, $_SESSION['user_id'])) {
			$group = $this->groupModel->getGroupsById($id);

			$data = [
				'groupId' => $id,
				'groupName' => $group->groupName
			];
				
				$this->view('groups/group', $data);
		}else{
			redirect('users');
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////

	public function newGroup()
	{
		 // check for post
		 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
			
			$name = trim(filter_input(INPUT_POST, 'group-name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
			$users = (isset($_POST['group-users'])) ? $_POST['group-users'] : '';

			if (!empty($name) && !empty($users)) {

				$otherUsers = implode(',', $users);
				if($groupId = $this->groupModel->create($_SESSION['user_id'], $name, $otherUsers)){

					$data = [
						'groupId' => $groupId,
						'groupName' => $name
					];
					$this->view('groups/group', $data);

				}

			}else{
				$users = $this->userModel->getAllOtherUsers($_SESSION['user_id']);
				$this->view('groups/newGroup', $users);
			}

    }else{
			$users = $this->userModel->getAllOtherUsers($_SESSION['user_id']);
			$this->view('groups/newGroup', $users);
		}
		
	}

	
} // end class


