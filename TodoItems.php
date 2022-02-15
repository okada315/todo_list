<?php

class TodoItems extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function selectAll()
    {
        $sql = '';
        $sql .= 'select ';
        $sql .= 't.id,';
        $sql .= 't.user_id,';
        $sql .= 'u.family_name,';
        $sql .= 'u.first_name,';
        $sql .= 't.item_name,';
        $sql .= 't.registration_date,';
        $sql .= 't.expire_date,';
        $sql .= 't.finished_date ';
        $sql .= 'from todo_items t ';
        $sql .= 'inner join users u on t.user_id=u.id ';
        $sql .= 'where t.is_deleted=0 ';
        $sql .= 'order by t.expire_date asc';

        $stmt = $this->dbh->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTodoItemById($data) {
        
        $sql = '';
        $sql .= 'update todo_items set ';
        $sql .= 'item_name=:item_name,';
        $sql .= 'registration_date=:registration_date,';
        $sql .= 'expire_date=:expire_date,';
        $sql .= 'finished_date=:finished_date ';
        $sql .= 'where id=:id ';
        
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':item_name', $data['item_name'], PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $data['registration_date'], PDO::PARAM_STR);
        $stmt->bindValue(':expire_date', $data['expire_date'], PDO::PARAM_STR);
        $stmt->bindValue(':finished_date', $data['finished_date'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
       
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTodoItemById($id) {

        $sql = '';
        $sql .= 'update todo_items set ';
        $sql .= 'is_deleted=1 ';
        $sql .= 'where id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $sql = '';
        $sql .= 'insert into todo_items (';
        $sql .= 'user_id,';
        $sql .= 'item_name,';
        $sql .= 'registration_date,';
        $sql .= 'expire_date,';
        $sql .= 'finished_date';
        $sql .= ') values (';
        $sql .= ':user_id,';
        $sql .= ':item_name,';
        $sql .= ':registration_date,';
        $sql .= ':expire_date,';
        $sql .= ':finished_date';
        $sql .= ')';

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':item_name', $data['item_name'], PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $data['registration_date'], PDO::PARAM_STR);
        $stmt->bindValue(':expire_date', $data['expire_date'],PDO::PARAM_STR);
        $stmt->bindValue('finished_date', $data['finished_date'], PDO::PARAM_STR);

        $stmt->execute();
    }

    public function getTodoItemById($id) {

        $sql = '';
        $sql .= 'select ';
        $sql .= 't.id,';
        $sql .= 't.user_id,';
        $sql .= 'u.family_name,';
        $sql .= 'u.first_name,';
        $sql .= 't.item_name,';
        $sql .= 't.registration_date,';
        $sql .= 't.expire_date,';
        $sql .= 't.finished_date ';
        $sql .= 'from todo_items t ';
        $sql .= 'inner join users u on t.user_id=u.id ';
        $sql .= 'where t.user_id=:id ';
        $sql .= 'and t.is_deleted=0';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function makeTodoItemComplete($id, $date = null) {

        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        $sql = '';
        $sql .= 'update todo_items set ';
        $sql .= 'finished_date=:finished_date ';
        $sql .= 'where id=:id';

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':finished_date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
