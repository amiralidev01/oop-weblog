<?php namespace App\Controller;

use App\Helpers\Validation;
use Plasticbrain\FlashMessages\FlashMessages;

class Controller
{
    public $flash;

    public function __construct()
    {
        $this->flash = new FlashMessages();
    }

    /**
     * @param $data
     * @param $rules
     * @return bool
     */
    public function validation($data, $rules)
    {
        $validation = new Validation();

        $valid = $validation->make($_POST, $rules);
        if (!$valid) {
            foreach ($validation->getErrors() as $error) {
                $this->flash->error($error[0]);
            }
            return false;
        }
        return true;
    }
}
