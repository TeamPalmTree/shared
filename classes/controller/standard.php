<?php

class Controller_Standard extends Controller_Shared
{

    protected $document;
    protected $body;

    public function before()
    {

        // call parent first
        parent::before();

        // see if our site and section are set
        if (!isset($this->document))
            $this->document = new \Standard\Model\Model_Document();
        if (!isset($this->body))
            $this->body = new \Standard\Model\Model_Body();

        // set page only flag
        if ($this->body->only = Input::get('body', false))
        {
            // set the template if it wasn't already set (as this will likely be an AJAX request)
            if (!is_object($this->template))
                $this->template = \View::forge($this->template);
        }

        // set up standard template
        if (!is_object($this->template))
            return;

        // set up page
        $this->template->body = View::forge('standard/body');

    }

    public function after($response)
    {

        // perform template post processing
        if (is_object($this->template))
        {

            // see if we have the section viewmodel name set
            if (!isset($this->section->viewmodel_name))
            {
                // get content file
                $content_file = $this->template->body->content->file();
                // get body file parts
                $content_file_parts = explode('/', $content_file);
                // create model
                foreach ($content_file_parts as &$content_file_part)
                    $content_file_part = ucfirst($content_file_part);
                // get the page section viewmodel name
                $this->body->section_model_name =  implode('_', $content_file_parts) . '_Model';
            }

            // set template data
            $this->template->set(get_object_vars($this->document));
            // set section data
            $this->template->body->set(get_object_vars($this->body));

            // if we are in page only mode, response becomes section
            if ($this->body->only)
                $response = \Fuel\Core\Response::forge($this->template->body);

        }

        // return standard
        return parent::after($response);

    }

}
