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
     * @Route("/page", name="page")
     * @Route("/page/{page}", name="page/num")
     * @Request({"page": "int"})
	 */
	public function pageAction ($page = 0)
	{
        $resultNotes = [];
        $notes_m = new NotesModel;
        $query = $notes_m::query();
        $limit = 2;
        $count = $query->count();
        $pages = ceil($count / $limit);
        $page  = max(0, min($pages - 1, $page));
        $notes = array_values($query->orderBy('id', 'DESC')->offset($page * $limit)->limit($limit)->get());

        foreach ($notes as $key => $note)
        {
            $resultNotes[$key] = (object)[
                'id' => $note->id,
                'name' => $note->name,
                'date' => $note->date,
                'content' => $this->getShort($note->content)
            ];
        }


        return [
            '$view' => [
                'title' => 'Notes',
                'name' => 'notes:views/admin/index.php'
            ],
            'notes' => $resultNotes,
            'limit' => $limit,
            'pages' => $count,
        ];
	}

    /**
     * @Route("/page/ajax/notes", name="page/ajax/notes")
     * @Request({"page": "int"})
     */
    public function notesAjaxAction ($page = 0)
    {
        App::render('extension://notes/views/ajax/notes.php');
    }

	/**
	 * @Route("/page/view/{id}", name="page/view")
	 * @Request({"id": "int"})
	 */
	public function viewAction ($id = 0)
	{
		$note = new NotesModel();
		$query = $note::find($id);
		return [
			'$view' => [
				'title' => 'Notes',
				'name' => 'notes:views/admin/view.php'
			],
			'note' => $query
		];
	}
    /**
     * @Route("/page/edit/{id}", name="page/edit")
     * @Request({"id": "int"})
     */
    public function editAction ($id)
    {
        $note = new NotesModel();
        $query = $note::find($id);
        return [
            '$view' => [
                'title' => 'Notes',
                'name' => 'notes:views/admin/edit.php'
            ],
            'note' => $query
        ];
    }

	public function settingsAction ()
	{
			return [
				'$view' => [
					'title' => 'Settings of the notes form',
					'name' => 'notes:views/admin/settings.php'
				],
				'$data' => [
	                'config' => App::module('notes')->config()
	            ]
			];
	}

    /**
     * @Route("/add", name="add")
     */
    public function addAction ()
    {
        return [
            '$view' => [
                'title' => 'Settings of the notes form',
                'name' => 'notes:views/admin/edit.php'
            ],
        ];
    }

    /**
     * @Route("/ajax", name="ajax")
     * @Request({"data": "array"})
     */
    public function ajaxAction ($data)
    {
        $new = new NotesModel;
        if (isset($data['id']) and $data['id'] != "")
        {
            $data['content'] = str_replace("\n", "<br/>\n", $data['content']);
            $data['date'] = time();

            $new->find($data['id'])->save($data);
            return ['message' => "success"];
        }
        else
        {
            $data['content'] = str_replace("\n", "<br/>\n", $data['content']);
            $data['date'] = time();
            
            $new->create()->save($data);
            return ['message' => "OK"];
        }
    }



    /**
     * get short description from text
     *
     * @param string $content
     * @param int $length
     * @return string
     */
    private function getShort ($content, $length = 200)
    {
        if (strlen($content) > $length)
        {
            $str = strip_tags($content);
            $str = substr($str, 0, $length);
            $str = rtrim($str, "!,.-");
            $str = substr($str, 0, strrpos($str, ' '));
            return $str;
        }
        else
        {
            return $content;
        }
    }
}
