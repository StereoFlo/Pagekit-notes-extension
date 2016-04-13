<?php $view->script('notes', 'notes:js/editor.js', 'jquery') ?>
<?php $view->script('notes-edit', 'notes:js/nicEdit-latest.js', 'jquery') ?>

<div class="uk-form uk-form-horizontal uk-width-1-1">
    <ul class="uk-list uk-list-line">
        <li class="uk-text">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-panel-box" id="form">
                    <div class="uk-panel-badge uk-badge"><?= isset($note->date) ? $note->date : 'Its a new note' ?></div>
                    <h3 class="uk-panel-title">
                        <a href="/admin/notes/page">[&lt;]</a>
                        <?php if (isset($note->id)) { ?>
                        <a href="/admin/notes/page/view/<?= $note->id ?>">[View]</a>
                        <?php } ?>
                        | <input type="text" id="name" value="<?= isset($note->name) ? $note->name : '' ?>" <?= isset($note->name) ? 'disabled' : '' ?>>
                    </h3>
                    <textarea id="content" style="width: 100%" rows="20">
                        <?= isset($note->content) ? $note->content : null ?>
                    </textarea>
                    <?php if (isset($note->id)) { ?>
                        <input type="hidden" id="edit" value="<?= $note->id ?>">
                    <?php } ?>
                    <button type="button" id="btnSubmit">Submit</button>
                </div>
            </div>
        </li>
    </ul>
</div>
