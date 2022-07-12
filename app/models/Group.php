<?php

/**
 * Group model
 */
class Group
{
  private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
    $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

  // create new group
  public function create($userId, $groupName, $users)
  {
    
      $this->db->query("INSERT INTO groups(groupName, userCreate, users) VALUES(:groupName, :userCreate, :users)");

      //bind values
      $this->db->bind(':groupName', $groupName);
      $this->db->bind(':userCreate', $userId);
      $this->db->bind(':users', $users);

      // execute
      if ($this->db->execute()) {
        return $this->db->lastId();
      }else{
        return false;
      }
    
  }

////////////////////////////////////////////////////////////////////////////

  public function getGroupsByUser($userId)
  {
    $this->db->query('SELECT * FROM groups where userCreate = :id or INSTR(`users`, :id) > 0');
    // bind value
    $this->db->bind(':id', $userId);

    $results = $this->db->resultSet();
    return $results;
  }

////////////////////////////////////////////////////////////////////////////

  public function getGroupsById($id)
  {
    $this->db->query('SELECT * FROM groups where groupId = :id');
    // bind value
    $this->db->bind(':id', $id);

    $results = $this->db->single();
    return $results;
  }

////////////////////////////////////////////////////////////////////////////

  public function checkForGroupOwner($groupId, $userId)
  {
    $this->db->query('SELECT groupId FROM groups where groupId = :groupId AND (userCreate = :id or INSTR(`users`, :id) > 0)');
    // bind value
    $this->db->bind(':groupId', $groupId);
    $this->db->bind(':id', $userId);

    $row = $this->db->single();

    //check row
    if ($this->db->rowCount() > 0) {
      return true;
    }else{
      return false;
    }
  }


} // end class