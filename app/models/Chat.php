<?php

/**
 * Chat model
 */
class Chat
{
  private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
    $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

  // insert message into DB
  public function insertMessage($userFrom, $userTo, $msg)
  {
    if (!empty($msg)) {
      $this->db->query("INSERT INTO messages(userFrom, userTo, msg) VALUES(:userFrom, :userTo, :msg)");

      //bind values
      $this->db->bind(':userFrom', $userFrom);
      $this->db->bind(':userTo', $userTo);
      $this->db->bind(':msg', $msg);

      $this->db->execute();
    }
  }

////////////////////////////////////////////////////////////////////////////

  // get all messages from two users
  public function getChats($userFrom, $userTo) 
  {
    $this->db->query("SELECT * FROM messages LEFT JOIN users ON users.userId = messages.userFrom WHERE (userFrom = :userFrom AND userTo = :userTo) OR (userFrom = :userTo AND userTo = :userFrom) ORDER BY msgId");

    $this->db->bind(':userFrom', $userFrom);
    $this->db->bind(':userTo', $userTo);

    $result = $this->db->resultSet();

    return $result;
  }

////////////////////////////////////////////////////////////////////////////

  // insert group message into DB
  public function insertGroupMessage($userFrom, $groupId, $msg)
  {
    if (!empty($msg)) {
      $this->db->query("INSERT INTO groupsmsg(userFrom, groupId, msg) VALUES(:userFrom, :groupId, :msg)");

      //bind values
      $this->db->bind(':userFrom', $userFrom);
      $this->db->bind(':groupId', $groupId);
      $this->db->bind(':msg', $msg);

      $this->db->execute();
    }
  }

////////////////////////////////////////////////////////////////////////////

   // get all group messages 
   public function getGroupChats($groupId) 
   {
     $this->db->query("SELECT * FROM groupsmsg LEFT JOIN users ON users.userId = groupsmsg.userFrom  where groupId = :groupId ORDER BY groupMsgId");
 
     $this->db->bind(':groupId', $groupId);
 
     $result = $this->db->resultSet();
 
     return $result;
   }

////////////////////////////////////////////////////////////////////////////

} // end class