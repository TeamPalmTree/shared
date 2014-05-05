<?php

class Controller_Standard extends Controller_Shared
{

    protected $document;

    public function before()
    {

        // call parent first
        parent::before();

        // see if our site and section are set
        if (!isset($this->document))
            $this->document = new \Standard\Model\Model_Document();

        // set body only flag
        if ($this->document->body_only = Input::get('body', false))
        {
            // set the template if it wasn't already set (as this will likely be an AJAX request)
            if (!is_object($this->template))
                $this->template = \View::forge($this->template);
        }

        // set up standard template
        if (!is_object($this->template))
            return;

        // set up head
        $this->template->head = View::forge('standard/head');
        // set up body
        $this->template->body = View::forge('standard/body');

    }

    public function after($response)
    {

        // perform template post processing
        if (is_object($this->template))
        {

            // see if we have the section viewmodel name set
            if (!isset($this->document->section_model))
            {
                // get content file
                $content_file = $this->template->body->content->file();
                // get body file parts
                $content_file_parts = explode('/', $content_file);
                // create model
                foreach ($content_file_parts as &$content_file_part)
                    $content_file_part = ucfirst($content_file_part);
                // get the page section viewmodel name
                $this->document->section_model =  implode('_', $content_file_parts) . '_Model';
            }

            // set global view data
            $this->template->set_global(get_object_vars($this->document));

            // if we are in page only mode, response becomes section
            if ($this->document->body_only)
                $response = \Fuel\Core\Response::forge($this->template->body);

        }

        // return standard
        return parent::after($response);

    }

}
