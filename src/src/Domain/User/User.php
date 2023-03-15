<?php
declare(strict_types=1);

namespace App\Domain\User;

class User {
    public function __construct(
        protected \mysqli $db,
        protected int $id)
    {
    }

    public function getData()
    {
        $stmt = $this->db->prepare(
        'SELECT `id`, `first_name`, `last_name`, `card_number`
        FROM `employees`
        WHERE `id` = ?');

        $stmt->bind_param('i', $this->id);
        $stmt->execute();

        if(!$result = $stmt->get_result())
        {
            // failure, we'll need to handle this somehow AND it would
            // be a good idea to log it somewhere safe.
            throw new Exception("Database error.");
        }

        if(!$data = $result->fetch_assoc())
        {
            throw new Exception("no data returned for ID.");
        }

        $result->free();
        return (object) $data;
    }

    public function getDepartments()
    {
        $stmt = $this->db->prepare(
        'SELECT `departments`.`name`
        FROM `employees_departments`
        LEFT JOIN `departments` ON `employees_departments`.`department_id` = `departments`.`id`
        WHERE `employees_departments`.`employee_id` = ?');

        $stmt->bind_param('i', $this->id);
        $stmt->execute();

        if(!$result = $stmt->get_result())
        {
            // failure, we'll need to handle this somehow AND it would
            // be a good idea to log it somewhere safe.
            throw new Exception("Database error.");
        }

        // return departments as a list of names
        $departments = $result->fetch_all(MYSQLI_ASSOC);

        $result->free();

        // wrap around the results object and just give us a simple list
        // of departments with no mysql nonsense
        // we also handle cases when employees don't have at least one
        // department assigned
        if(isset($departments[0]))
        {
            return array_map(fn($row): string => $row['name'], $departments);
        }

        // empty
        return array();
    }
}
?>