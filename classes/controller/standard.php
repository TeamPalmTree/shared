<?php

class Controller_Standard extends Controller_Shared
{

    public $site = 'TPT';

    public function router($method, $params)
    {

        ////////////////////
        // TEMPLATE SETUP //
        ////////////////////

        // if we aren't restful and aren't passing a REST key
        // set up the template for the UI
        if (!$this->is_restful())
        {
            $this->template->modal = View::forge('standard/modal');
            $this->template->section = View::forge('standard/section');
        }

        // forward to parent router
        parent::router($method, $params);

    }

}
