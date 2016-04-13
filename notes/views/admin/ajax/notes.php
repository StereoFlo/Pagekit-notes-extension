<?php if (empty($notes)) { ?>
    <div class="uk-alert">No notes</div>
<?php } else { ?>
    <ul class="uk-list uk-list-line">
        <?php foreach ($notes as $note) { ?>
            <li class="uk-text">
                <div class="uk-width-medium-1-1">
                    <div class="uk-panel uk-panel-box">
                        <div class="uk-panel-badge uk-badge"><?= $note->date ?></div>
                        <h3 class="uk-panel-title"><a href="/admin/notes/page/view/<?= $note->id ?>"><?= $note->name ?></a></h3>
                        <?= $note->content ?>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } ?>