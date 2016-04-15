<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
    <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>
        <h2 class="uk-margin-remove"><?= $count ?> notes</h2>
        <div class="pk-search">
            <div class="uk-search">
                <form action="/notes">
                    <input class="uk-search-field" name="search" type="text" id="searchForm" placeholder="Search">
                </form>
            </div>
        </div>
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
							<h3 class="uk-panel-title"><a href="/notes/view/<?= $note->id ?>"><?= $note->name ?></a></h3>
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
        <a href="/notes/<?= $all['centerFirst']?>"><i class="uk-icon-angle-double-left"></i> Previos</a>
    </li>
    <li class="uk-active">
        <span><?= $all['centerMiddle'] ?></span>
    </li>
    <li <?= isset($all['centerLast']) ? 'class="uk-disabled"' : '' ?>>
        <a href="/notes/<?= $all['centerLast']?>">Next <i class="uk-icon-angle-double-right"></i></a>
    </li>
</ul>