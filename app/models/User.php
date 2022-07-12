<?php

/**
 * User model
 */
class User
{
  private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
      $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

   // find user by username
   public function findUserByUsername($username)
   {
       $this->db->query('SELECT * FROM users WHERE username = :username');
       // bind value
       $this->db->bind(':username', $username);
 
       $row = $this->db->single();
 
       // check row
       if ($this->db->rowCount() > 0) {
         return true;
       }else{
         return false;
       }
   }

////////////////////////////////////////////////////////////////////////////

  // find user by email
  public function findUserByEmail($email)
  {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // check row
      if ($this->db->rowCount() > 0) {
        return true;
      }else{
        return false;
      }
  }

////////////////////////////////////////////////////////////////////////////

  //register user, insert data in DB
  public function register($data)
  {
    $this->db->query('INSERT INTO users (username, email, password, image) VALUES(:username, :email, :password, :image)');
    // bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':image', $data['profilePic']);

    // execute
    if ($this->db->execute()) {
      return true;
    }else{
      return false;
    }
  }

////////////////////////////////////////////////////////////////////////////

  //login user
  public function login($email, $password) 
  {
    $this->db->query("SELECT * FROM users WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashedPassword = $row->password;

    // check for password matches
    if (password_verify($password, $hashedPassword)) {
      return $row;
    }else{
      return false;
    }
  }

////////////////////////////////////////////////////////////////////////////

  public function getUserById($id)
  {
    $this->db->query('SELECT userId, username, image FROM users WHERE userId = :id');
    // bind value
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

/////////////////////////////////////////////////////////////////////////////

  public function getAllOtherUsers($id) 
  {
    $this->db->query('SELECT userId, username, image FROM users WHERE NOT userId = :id ORDER BY userId DESC');
    // bind value
    $this->db->bind(':id', $id);

    $results = $this->db->resultSet();
    return $results;
  }

} // end class