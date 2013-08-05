<?php

class Controller_TeamPalmTree extends Controller_Shared
{
    public $template = 'teampalmtree';

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