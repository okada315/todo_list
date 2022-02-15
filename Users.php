<?php

class Users extends Base
{
    
    public function __construct()
    {
        parent::__construct();
    }

    // ユーザー登録
    public function addUser($user, $pass, $family_name, $first_name): bool
    {
        if (!empty($this->findUserByEmail($user))) {
            return false;
        }

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = 'insert into users (user, pass, family_name, first_name)';
        $sql .= ' values ';
        $sql .= '(:user, :pass, :family_name, :first_name)';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':family_name', $family_name, PDO::PARAM_STR);
        $stmt->bindValue('first_name', $first_name,PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

   public function getUser($user, $pass)
    {
        $rec = $this->findUserByEmail($user);
        if (empty($rec)) {
            return [];
        }

        if (password_verify($pass, $rec['pass'])) {
            return $rec;
        }
        return [];
    }

    private function findUserByEmail($user)
    {
        $sql = 'select * from users where user=:user';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->execute();
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($rec)) {
            return [];
        }
        return $rec;
    }

    public function isExistsUser($id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        if ($id <= 0) {
            return false;
        }

        $sql = '';
        $sql .= 'select count(id) as num from users where is_deleted=0';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $ret = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ret['num'] == 0) {
            return false;
        }

        return true;
    }
}