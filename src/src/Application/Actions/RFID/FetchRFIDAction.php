<?php
declare(strict_types=1);

namespace App\Application\Actions\RFID;

use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\User\UserFactory;

class FetchRFIDAction extends RFIDAction
{
    protected function action(): Response
    {
        $host = 'mysql';
        $username = 'hackerman';
        $password = 'el1t3passw0rd';
        $dbname = 'sgnldb';

        $db = new \mysqli($host, $username, $password, $dbname);

        // default, usually when the uid isn't found
        $emptyResponse = array(
            'full_name' => "",
            'department' => array()
        );

        $params = $this->request->getQueryParams();

        // no uid specified
        if(!isset($params['cn']))
        {
            // make an error
            return $this->response->withStatus(404);
        }

        $uid = $params['cn'];

        if($uid === 'not_found')
        {
            return $this->respondWithData($emptyResponse);
        }

        // validate param
        if(!preg_match("/[0-9a-zA-Z]{32}/i", $uid))
        {
            return $this->response->withStatus(500);
        }

        $user = UserFactory::resolveFromRFID($db, $uid);

        if($user !== false)
        {
            $data = $user->getData();

            return $this->respondWithData(array(
                'full_name' => "{$data->first_name} {$data->last_name}",
                'department' => $user->getDepartments()
            ));
        }

        // default catch all response.
        return $this->respondWithData($emptyResponse);
    }
}
?>