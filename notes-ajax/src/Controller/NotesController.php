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
                'title' => __('Notes'),
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
                'layout' => false,
				'title' => __('Note view'),
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
                'layout' => false,
                'title' => __('Note edit'),
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
                'title' => __('Settings'),
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
                'layout' => false,
                'title' => __('Add a note'),
                'name' => 'notes:views/admin/edit.php'
            ],
        ];
    }

}
