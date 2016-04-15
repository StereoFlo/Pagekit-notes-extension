<div class="uk-form uk-form-horizontal uk-width-1-1">
        <ul class="uk-list uk-list-line">
                <li class="uk-text">
                    <div class="uk-width-medium-1-1">
                        <div class="uk-panel uk-panel-box">
                            <div class="uk-panel-badge uk-badge"><?= $note->date ?></div>
                            <h3 class="uk-panel-title">
                                <a href="/notes">[&lt;]</a>
                                | <?= $note->name ?>
                            </h3>
                            <?= $note->content ?>
                        </div>
                    </div>
                </li>
        </ul>
</div>
