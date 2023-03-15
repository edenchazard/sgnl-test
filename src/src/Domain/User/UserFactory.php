<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\RFID\RFIDManagement;

class UserFactory
{
    public static function resolveFromRFID(\mysqli $db, string $card_uid)
    {
        $userID = RFIDManagement::cardInDB($db, $card_uid);

        if($userID === false)
        {
            // TODO record didn't exist, handle it.
            return false;
        }

        $user = new User($db, $userID);
        return $user;
    }

    public static function get(int $id)
    {
        // TODO fetch a user via their id.
    }
}
?>