<?php
namespace Pagekit\Notes\Controller;

use Pagekit\Application as App;
use Pagekit\Notes\Model\NotesModel;
use Pagekit\Notes\Libraries\Helpers;


/**
 * @Access(admin=true)
 * 
 */
class NotesController
{
    private $helpers;
    private $config;

    /**
     * NotesController constructor.
     */
    public function __construct()
    {
        $this->config = App::module('notes')->config();
    }

    /**
     * @Route("/page", name="page")
     * @Route("/page/{page}", name="page/num")
     * @Request({"page": "int"})
	 */
	public function pageAction ($page = 1)
	{
        $this->helpers = new Helpers();
        $resultNotes = [];
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
        $notes = $query->offset(($page - 1) * $limit)->limit($limit)->orderBy('id', 'DESC')->get();

        $centerPages = $this->helpers->getPagination(1, $page, $total);

        foreach ($notes as $key => $note)
        {
            $resultNotes[] = (object)[
                'id' => $note->id,
                'name' => $note->name,
                'date' => $note->date,
                'content' => $this->helpers->getShort($note->content)
            ];
        }

        return [
            '$view' => [
                'title' => 'Notes',
                'name' => 'notes:views/admin/index-ajax.php'
            ],

            '$data' => [
                'entries' => $resultNotes,
                'limit' => $limit,
                'count' => $count,
            ],
            'total' => $total,
            'page' => $page,
            'all' => $centerPages
        ];
	}

    /**
     * @Route("/page/ajax/notes", name="page/ajax/notes")
     * @Route("/page/ajax/notes/{page}", name="page/ajax/notes/num")
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
                'content' => $this->helpers->getShort($note->content)
            ];
        }
        return compact('notes', 'page', 'count', 'total');
    }

	/**
	 * @Route("/page/view/{id}", name="page/view")
	 * @Request({"id": "int"})
	 */
	public function viewAction ($id)
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

    /**
     * Route("/settings", name="settings")
     */
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
     * @Route("/ajax/add", name="ajax/add")
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

    /**
     * @Route("/ajax/delete", name="ajax/delete")
     * @Request({"data": "array"})
     */
    public function deleteAjaxAction ($data)
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

    public function settings ()
    {
        return [
            '$view' => [
                'title' => __('Hello Settings'),
                'name'  => 'notes:views/admin/settings.php'
            ],
            '$data' => [
                'config' => App::module('notes')->config()
            ]
        ];
    }
}
