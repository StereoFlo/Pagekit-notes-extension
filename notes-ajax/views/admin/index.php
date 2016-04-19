<?php $view->script('main', 'notes:js/page.js', 'jquery') ?>
<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>
        <h2 class="uk-margin-remove"><?= $count ?> notes</h2>
        <div class="pk-search">
            <div class="uk-search">
                <form action="/admin/notes/page">
                    <input class="uk-search-field" name="search" type="text" id="searchForm" placeholder="Search">
                </form>
            </div>
        </div>
    </div>
    <div data-uk-margin>
        <a class="uk-button uk-button-primary" href="/admin/notes/add">Add a new</a>
    </div>
</div>
<div class="uk-form uk-form-horizontal uk-width-1-1">
	<?php if (empty($notes)) { ?>
		<div class="uk-alert">There are no notes</div>
	<?php } else { ?>
		<ul class="uk-list uk-list-line">
			<?php foreach ($notes as $note) { ?>
				<li class="uk-text" id="note_<?= $note->id ?>">
					<div class="uk-width-medium-1-1">
						<div class="uk-panel uk-panel-box">
							<div class="uk-panel-badge uk-badge"><?= $note->date ?></div>
							<h3 class="uk-panel-title"><a href="/admin/notes/page/view/<?= $note->id ?>"><?= $note->name ?></a> | <a id="delete_<?= $note->id ?>" href="#delete" onclick="return false;">[x]</a></h3>
							<?= $note->content ?>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	<?php } ?>
</div>
<ul class="uk-pagination">
    <li <?= isset($all['centerFirst']) ? 'class="uk-disabled"' : '' ?>>
        <a href="/admin/notes/page/<?= $all['centerFirst']?>"><i class="uk-icon-angle-double-left"></i> Previos</a>
    </li>
    <li class="uk-active">
        <span><?= $all['centerMiddle'] ?></span>
    </li>
    <li <?= isset($all['centerLast']) ? 'class="uk-disabled"' : '' ?>>
        <a href="/admin/notes/page/<?= $all['centerLast']?>">Next <i class="uk-icon-angle-double-right"></i></a>
    </li><div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>
            <h2 class="uk-margin-remove"><?= $count ?> notes</h2>
            <div class="pk-search">
                <div class="uk-search">
                    <form action="/admin/notes/page">
                        <input class="uk-search-field" name="search" type="text" id="searchForm" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <div data-uk-margin>
            <a class="uk-button uk-button-primary" href="/admin/notes/add">Add a new</a>
        </div>
    </div>
    <div class="uk-form uk-form-horizontal uk-width-1-1">
        <?php if (empty($notes)) { ?>
            <div class="uk-alert">There are no notes</div>
        <?php } else { ?>
            <ul class="uk-list uk-list-line">
                <?php foreach ($notes as $note) { ?>
                    <li class="uk-text" id="note_<?= $note->id ?>">
                        <div class="uk-width-medium-1-1">
                            <div class="uk-panel uk-panel-box">
                                <div class="uk-panel-badge uk-badge"><?= $note->date ?></div>
                                <h3 class="uk-panel-title"><a href="/admin/notes/page/view/<?= $note->id ?>"><?= $note->name ?></a> | <a id="delete_<?= $note->id ?>" href="#delete" onclick="return false;">[x]</a></h3>
                                <?= $note->content ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
    <ul class="uk-pagination">
        <li <?= isset($all['centerFirst']) ? 'class="uk-disabled"' : '' ?>>
            <a href="/admin/notes/page/<?= $all['centerFirst']?>"><i class="uk-icon-angle-double-left"></i> Previos</a>
        </li>
        <li class="uk-active">
            <span><?= $all['centerMiddle'] ?></span>
        </li>
        <li <?= isset($all['centerLast']) ? 'class="uk-disabled"' : '' ?>>
            <a href="/admin/notes/page/<?= $all['centerLast']?>">Next <i class="uk-icon-angle-double-right"></i></a>
        </li>
    </ul>
</ul>