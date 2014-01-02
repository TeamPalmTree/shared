<?php

class Controller_Shared extends Controller_Auth
{

    public function before()
    {
        // call parent before required
        parent::before();

        ///////////////////
        // SET UP HELPER //
        ///////////////////

        // set global timezones
        Helper::$server_timezone = new DateTimeZone(Config::get('default_timezone'));
        Helper::$user_timezone = new DateTimeZone('America/New_York');

    }

    public function errors_response($errors) {
        return $this->response($errors)->set_header('errors', true);
    }

}
