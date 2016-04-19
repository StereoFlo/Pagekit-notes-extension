<?php
namespace Pagekit\Notes\Controller;

use Pagekit\Application as App;
use Pagekit\Notes\Model\NotesModel;


/**
 * @Access(admin=true)
 */
class NotesController
{
    /**
     * @Route("/page", name="page")
	 */
	public function pageAction ()
	{
        return [
            '$view' => [
                'title' => 'Notes',
                'name' => 'notes:views/admin/index-ajax.php'
            ]
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
    public function settingsAction()
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

}
