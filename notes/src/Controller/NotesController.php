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
	public function pageAction ($page = 1)
	{
        $config = App::module('notes')->config();
        $resultNotes = [];
        $notes_m = new NotesModel;
        $query = $notes_m::query();
        $limit = isset($config['limit']) ? $config['limit'] : 10;

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

        $centerPages = $this->getPagination(1, $page, $total);

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
            'count' => $count,
            'total' => $total,
            'page' => $page,
            'all' => $centerPages
        ];
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
                'config' => App::module('hello')->config()
            ]
        ];
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

    /**
     * build a pagination
     *
     * @param int $page first page
     * @param int $current current page
     * @param int $total number of all pages
     * @return object
     */
    private function getPagination($page, $current, $total)
    {
        $result = [];
        $result['first'] = (int) $page;
        $result['current'] = (int) $current;
        $result['last'] = (int) $total;

        if ($current == $page && $current == $total)
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        elseif ($current == $page && $current < $total)
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = $current + 1;
        }
        elseif ($current > $page && $current < $total)
        {
            $result['centerFirst'] = $current - 1;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = $current + 1;
        }
        elseif ($current > $page && $current == $total)
        {
            $result['centerFirst'] = $current - 1;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        else
        {
            $result['centerFirst'] = null;
            $result['centerMiddle'] = $current;
            $result['centerLast'] = null;
        }
        return $result;
    }
}
