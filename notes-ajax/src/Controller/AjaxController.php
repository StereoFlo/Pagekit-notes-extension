<?php
namespace Pagekit\Notes\Controller;

use Pagekit\Application as App;
use Pagekit\Notes\Libraries\Helpers;
use Pagekit\Notes\Model\NotesModel;

/**
 * @Route("ajax", name="ajax")
 */
class AjaxController
{
    private $helpers;
    private $config;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->config = App::module('notes')->config();
    }

    /**
     * @Route("/notes", name="ajax/notes")
     * @Route("/notes/{page}", name="ajax/notes/num")
     * @Request({"page": "int"})
     */
    public function pageAjaxAction ($page = 1)
    {
        $this->helpers = new Helpers();
        $notes = [];
        $notes_m = new NotesModel;
        $query = $notes_m::query();
        $limit = isset($this->config['limit']) ? $this->config['limit'] : 10;

        $search = isset($_GET['search']) ? $_GET['search'] : null;
        if (!is_null($search))
        {
            $query->where(function ($query) use ($search)
            {
                $query->orWhere(['name LIKE :search', 'content LIKE :search'], ['search' => "%{$search}%"]);
            });
        }

        $count = $query->count('id');
        $total = ceil($count / $limit);
        $page = max(1, min($total, $page));
        $tmpNotes = $query->offset(($page - 1) * $limit)->limit($limit)->orderBy('id', 'DESC')->get();

        foreach ($tmpNotes as $key => $note)
        {
            $notes[] = (object)[
                'id' => $note->id,
                'name' => $note->name,
                'date' => $note->date,
                'content' => $this->helpers->getShort($note->content, $this->config['symbols'])
            ];
        }
        return compact('notes', 'page', 'count', 'total');
    }

    /**
     * @Route("/delete", name="ajax/delete", methods="POST")
     * @Request({"data": "array"})
     */
    public function deleteAction ($data)
    {
        $new = new NotesModel;
        if (isset($data['id']) and $data['id'] != "" and is_numeric($data['id']))
        {
            $new->find($data['id'])->delete();
            return ['error' => 0, 'message' => "success"];
        }
        else
        {
            return ['error' => 1, 'message' => "id is not correct"];
        }
    }

    /**
     * @Route("/add", name="ajax/add", methods="POST")
     * @Request({"data": "array"})
     */
    public function addAjaxAction ($data)
    {
        $new = new NotesModel;
        if (isset($data['id']) and $data['id'] != "")
        {
            $data['date'] = time();
            $new->find($data['id'])->save($data);
            return ['message' => "Successfully updated"];
        }
        else
        {
            $data['date'] = time();
            $new->create()->save($data);
            return ['message' => "Successfully added"];
        }
    }
}