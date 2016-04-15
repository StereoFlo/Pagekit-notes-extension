<?php
namespace Pagekit\Notes\Model;

use Pagekit\Application as App;
use Pagekit\Database\ORM\ModelTrait;
/**
 * @Entity(tableClass="@notes_data")
 */
class NotesModel implements \JsonSerializable {
    use ModelTrait;

/* --------------- FIELDS --------------- */
    /** @Column(type="integer") @id */
    public $id;
    /** @Column(type="string") */
    public $name;
    /** @Column(type="text") */
    public $content;
    /** @Column(type="string") */
    public $date;

	  /**
	   * {@inheritdoc}
	   */
    public function jsonSerialize ()
	{
        return $this->toArray([]);
    }

	public function toArray ()
	{
		return App::db()
            ->createQueryBuilder()
            ->from('@notes_data')
            ->get();
	}
}
