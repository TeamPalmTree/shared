<?php

class Controller_Standard extends Controller_Shared
{

    protected $site;
    protected $section;

    public function before()
    {

        // call parent first
        parent::before();

        // see if our site and section are set
        if (!isset($this->site))
            $this->site = new \Standard\Model\Model_Site();
        if (!isset($this->section))
            $this->section = new \Standard\Model\Model_Section();

        // set section only flag
        if ($this->section->only = Input::get('section_only', false))
        {
            // set the template if it wasn't already set (as this will likely be an AJAX request)
            if (!is_object($this->template))
                $this->template = \View::forge($this->template);
        }

        // set up standard template
        if (!is_object($this->template))
            return;

        // set up modal and section views
        $this->template->modal = View::forge('standard/modal');
        $this->template->section = View::forge('standard/section');

    }

    public function after($response)
    {

        // perform template post processing
        if (is_object($this->template))
        {

            // see if we have the section viewmodel name set
            if (!isset($this->section->viewmodel_name))
            {
                // get body file
                $body_file = $this->template->section->body->file();
                // get body file parts
                $body_file_parts = explode('/', $body_file);
                // create model
                foreach ($body_file_parts as &$body_file_part)
                    $body_file_part = ucfirst($body_file_part);
                // get the section viewmodel name
                $this->section->viewmodel_name =  implode('_', $body_file_parts) . '_Model';
                // get the section viewmodel id
                if (!isset($this->section->viewmodel_id))
                    $this->section->viewmodel_id = str_replace('/', '-', $body_file);
            }

            // set template data
            $this->template->set(get_object_vars($this->site));
            // set section data
            $this->template->section->set(get_object_vars($this->section));

            // if we are in section only mode, response becomes section
            if ($this->section->only)
                $response = \Fuel\Core\Response::forge($this->template->section);

        }

        // return standard
        return parent::after($response);

    }

}
