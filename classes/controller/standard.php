<?php

class Controller_Standard extends Controller_Shared
{

    public $site = 'Standard';
    public $section = 'Index';

    public function before()
    {

        // call parent first
        parent::before();
        // set up standard template
        if (is_object($this->template))
        {
            $this->template->modal = View::forge('standard/modal');
            $this->template->section = View::forge('standard/section');
        }

    }

}
