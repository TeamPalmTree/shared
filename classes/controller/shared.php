<?php

class Controller_Shared extends Controller_Hybrid
{
    public $section;

    public function before()
    {
        // call parent before required
        parent::before();

        //////////////////////////////
        // SET TIMEZONE INFORMATION //
        //////////////////////////////

        // set global timezones
        Helper::$server_timezone = new DateTimeZone(Config::get('default_timezone'));
        Helper::$user_timezone = new DateTimeZone('America/New_York');

    }

    public function router($method, $params)
    {

        ////////////////////
        // TEMPLATE SETUP //
        ////////////////////

        // if we aren't restful and aren't passing a REST key
        // set up the template for the UI
        if (!$this->is_restful())
        {
            $this->template->network = View::forge('shared/network');
            $this->template->header = View::forge('shared/header');
            $this->template->footer = View::forge('shared/footer');
        }

        // forward to FPHP router
        parent::router($method, $params);

    }

}
