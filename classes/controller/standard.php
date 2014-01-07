<?php

class Controller_Standard extends Controller_Shared
{

    public $site = 'Standard';
    public $section = 'Index';

    public function router($method, $params)
    {

        // call parent before required
        parent::router($method, $params);
        // set up standard template
        if (is_object($this->template))
        {
            $this->template->modal = View::forge('standard/modal');
            $this->template->section = View::forge('standard/section');
        }

    }

}
