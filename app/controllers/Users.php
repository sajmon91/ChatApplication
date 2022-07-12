<?php
/**
 * User Controller
 * register and login user
 */
class Users extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->groupModel = $this->model('Group');
  }

////////////////////////////////////////////////////////////////////////

  // register user
  public function register()
  {
    // check for post request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize post data
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      // default profile picture assignment
			$pics = scandir(ROOT . '/public/img/defaults');
      $rand = rand(2,count($pics)-1);
			$pic = $pics[$rand];
      $profilePic = URLROOT . "/public/img/defaults/${pic}";

      // init data
      $data = [
        'username' => trim($username),
        'email' => trim($email),
        'password' => trim($password),
        'profilePic' => $profilePic,
        'username_err' => '',
        'email_err' => '',
        'password_err' => ''
      ];

      // validate username
      $specialChars = "/^[0-9a-zA-Z]*$/";

      if (empty($data['username'])) {
        $data['username_err'] = 'Please enter username';

      }else if (!preg_match($specialChars, $data['username'])) {
        $data['username_err'] = 'Username must be only letters and numbers';

      }else if ($this->userModel->findUserByUsername($data['username'])) {
        $data['username_err'] = 'Username is already taken';
      };

      // validate email
      $mailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";

      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';

      }else if (!preg_match($mailFormat, $data['email'])) {
        $data['email_err'] = 'Invalid email';

      }else if ($this->userModel->findUserByEmail($data['email'])) {
        $data['email_err'] = 'Email is already taken';
      };

      // validate password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';

      }else if (!preg_match($specialChars, $data['password'])) {
        $data['password_err'] = 'Password must be only letters and numbers';

      }else if (strlen($data['password']) < 3 || strlen($data['password']) > 20){
        $data['password_err'] = 'Password must be between 3 and 20 characters';
      };

      //make sure errors are empty
      if (empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err'])) {

        // hash password
	      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->userModel->register($data)) {
          setMessage('You are registered and can log in');
          redirect('users/login');
        };
        
      }else{
        // load view with errors
        $this->view('users/register', $data);
      };

    }else{
      // init data
      $data = [
        'username' => '',
        'email' => '',
        'password' => '',
        'username_err' => '',
        'email_err' => '',
        'password_err' => ''
      ];

      // load view
	    $this->view('users/register', $data);
    }
    
  }

  ///////////////////////////////////////////////////////////////////

  // login user
  public function login()
  {
    // check for post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // sanitize post data
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      // init data
      $data = [
        'email' => trim($email),
        'password' => trim($password),
        'email_err' => '',
        'password_err' => '',
      ];

      // validate email
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';

      }else if (!$this->userModel->findUserByEmail($data['email'])){
        $data['email_err'] = 'Wrong email';
      };

      // validate password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      };

      if (empty($data['email_err']) && empty($data['password_err'])) {
        
        // check and set logged in user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if ($loggedInUser) {
          // create sessions
          $this->createUserSession($loggedInUser);

        }else{
          $data['password_err'] = 'Wrong password';
        }
      }

      // load view with errors
      $this->view('users/login', $data);

    }else{
      // init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // load view
	    $this->view('users/login', $data);
    }
    
  }

/////////////////////////////////////////////////////////////////////////

  // create sessions
  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->userId;
    redirect('users');
  }

//////////////////////////////////////////////////////////////////////////

  // index when user is logged in
  public function index() 
  {
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    $userDetails = $this->userModel->getUserById($_SESSION['user_id']);
    $otherUsers = $this->userModel->getAllOtherUsers($_SESSION['user_id']);
    $groups = $this->groupModel->getGroupsByUser($_SESSION['user_id']);

    $data = [
      'user' => $userDetails,
      'others' => $otherUsers,
      'groups' => $groups
    ];
    $this->view('users/index', $data);
  }

//////////////////////////////////////////////////////////////////////////

  // logout user and session destroy
  public function logout()
  {
    unset($_SESSION['user_id']);
    session_destroy();
    redirect('users/login');
  }

//////////////////////////////////////////////////////////////////////////


} // end class


?>