<?php
namespace Pagekit\Notes\Controller;

use Pagekit\Application as App;
use Pagekit\Notes\Libraries\Helpers;
use Pagekit\Notes\Model\NotesModel;

class SiteController
{
	private $helpers;
	private $config;

	public function __construct()
	{
		$this->config = App::module('notes')->config();
	}

	/**
	* @Route ("/")
	* @Route ("/{page}", name="pageNum")
	*/
	public function indexAction ($page = 1)
	{
		$this->helpers = new Helpers();

		$this->config = App::module('notes')->config();
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
			$resultNotes[$key] = (object)[
				'id' => $note->id,
				'name' => $note->name,
				'date' => $note->date,
				'content' => $this->helpers->getShort($note->content)
			];
		}

		return [
			'$view' => [
				'title' => 'Notes',
				'name' => 'notes:views/site/index.php'
			],
			'count' => $count,
			'notes' => $resultNotes,
			'all' => $centerPages
		];
	}

	/**
	 * @Route("/view/{id}", name="view/num")
	 * @Request({"id": "int"})
	 */
	public function viewAction ($id)
	{
		$note = new NotesModel();
		$query = $note::find($id);
		return [
			'$view' => [
				'title' => 'Notes',
				'name' => 'notes:views/site/view.php'
			],
			'note' => $query
		];
	}

}
