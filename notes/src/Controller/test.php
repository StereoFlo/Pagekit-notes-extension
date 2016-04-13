<?php
namespace Pagekit\Notes\Controller;

use Pagekit\Application as App;
use Pagekit\Notes\Model\NotesModel;

/**
 * @Access(admin=true)
 *
 */
class NotesController
{
    /**
     * @Route("/page/ajax/notes", name="page/ajax/notes")
     * @Request({"page": "int"})
     */
    public function notesAjaxAction ($page = 0)
    {
        App::render('extension://notes/views/ajax/notes.php');
    }
}
