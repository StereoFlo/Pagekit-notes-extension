<div id="form" class="uk-form uk-form-horizontal uk-width-1-1">
    <ul class="uk-list uk-list-line">
        <li class="uk-text">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-panel-box" id="form">
                    <h3 class="uk-panel-title">
                        <input type="text" id="name" value="<?= isset($note->name) ? $note->name : '' ?>" <?= isset($note->name) ? 'disabled' : '' ?>>
                    </h3>
                    <textarea id="content" style="width: 100%" rows="20">
                        <?= isset($note->content) ? $note->content : null ?>
                    </textarea>
                    <?php if (isset($note->id)) { ?>
                        <input type="hidden" id="edit" value="<?= $note->id ?>">
                    <?php } ?>
                    <button type="button" class="uk-button" id="btnSubmit"><?= __('Submit') ?></button>
                </div>
            </div>
        </li>
    </ul>
</div>
<div id="result" style="display: none">
    <p><?= __('Note is successfully saved!') ?></p>
    <p><a href="/admin/notes/page"><?= __('Back to all notes') ?></a> </p>
</div>