<?php

namespace Pagekit\Notes\Controller;
use Pagekit\Application as App;
use Pagekit\Notes\Model\NotesModel;

/**
 * @Route("ax", name="ax")
 */
class AjaxController
{
    /**
     * @Route("/", name="ax/index")
     */
    public function indexAction()
    {
        return ['privet'];
    }
}