<?php
declare(strict_types=1);

namespace App\Domain\RFID;

class RFIDManagement {
    public static function cardInDB(\mysqli $db, string $uid)
    {
        $stmt = $db->prepare('
        SELECT `id`
        FROM `employees`
        WHERE `card_number` = ?');

        $stmt->bind_param('s', $uid);
        $stmt->execute();

        if(!$result = $stmt->get_result())
        {
            // failure, we'll need to handle this somehow AND it would
            // be a good idea to log it somewhere safe.
            throw new Exception("Database error.");
        }

        $employee = $result->fetch_assoc();

        $result->free();

        // if record doesn't exist, then return false.
        // otherwise, return the user id
        return ($employee ? $employee['id'] : false );
    }
}
?>