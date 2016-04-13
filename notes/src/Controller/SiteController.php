<?php
namespace Pagekit\Notes\Controller;
use Pagekit\Application as App;
use Pagekit\Notes\Model\NotesModel;

class SiteController {

	/**
	* @Route ("/")
	*/
	public function indexAction ()
	{
		return [
			'$view' => [
				'title' => __('Send a feedback'),
				'name' => 'notes:views/site/index.php'
			],
		];
	}

	/**
	* @Request({"data"})
	*/
	public function sendAction ($data)
	{
		$config = App::module('notes')->config();
		$mail = App::mailer()->create();
		$mail->setTo($config->email)
			 ->setSubject($data['name'] . ' have a question')
			 ->setBody($data['message'])
			 ->send();
		$data['date'] = time();
		$db = new NotesModel;
		$db->create()->save($data);
		return [
			'message' => __('You message has been sent')
		];
	}

}
