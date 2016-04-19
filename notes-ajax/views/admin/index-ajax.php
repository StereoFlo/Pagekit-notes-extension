<?php $view->script('notes', 'notes:js/editor.js', 'jquery') ?>
<?php $view->script('notes-edit', 'notes:js/nicEdit-latest.js', 'jquery') ?>
<?php $view->script('main', 'notes:js/page.js', ['jquery', 'vue']) ?>

<div id="notes">
<!--    <pre>{{ count | json }}</pre>-->
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div class="uk-flex uk-flex-middle uk-flex-wrap" data-uk-margin>
            <h2 class="uk-margin-remove">{{ count }} {{ 'notes' | trans }}</h2>
            <div class="pk-search">
                <div class="uk-search">
                    <form action="/admin/notes/page">
                        <input class="uk-search-field" name="search" type="text" id="searchForm" placeholder="{{ 'Search' | trans }}">
                    </form>
                </div>
            </div>
        </div>
        <div data-uk-margin>
            <a class="uk-button uk-button-primary" @click="editNote()" data-uk-modal="{target:'#my-id'}">{{ 'Add a note' | trans }}</a>
        </div>
    </div>
    <div class="uk-form uk-form-horizontal uk-width-1-1">
        <div class="uk-alert" v-if="!entries.length">{{ 'No notes' | trans }}</div>
        <ul class="uk-list uk-list-line" v-if="entries.length">
            <li class="uk-text" v-for="entry in entries">
                <div class="uk-width-medium-1-1">
                    <div class="uk-panel uk-panel-box">
                        <div class="uk-panel-badge uk-badge">{{ entry.date }}</div>
                        <h3 class="uk-panel-title">
                            <a @click="getNote(entry.id)" href="#view_{{ entry.id }}" onclick="return false;" data-uk-modal="{target:'#my-id'}">{{ entry.name }}</a>
                            | <a @click="editNote(entry.id)" href="#edit" onclick="return false;" data-uk-modal="{target:'#my-id'}"><i class="uk-icon-edit"></i></a>
                            | <a @click="remove(entry)" href="#delete" onclick="return false;"><i class="uk-icon-remove"></i></a>
                        </h3>
                        {{ entry.content }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <p>{{ 'Current page' | trans }}: {{ page }}</p>
    <ul class="uk-pagination">
        <li v-for="n in total">
            <div v-if="((n+1) > total) || ((n+1) != 0)">
                <a @click="getNotes(n+1)" href="#page_{{ n+1 }}" onclick="return false;">{{ n+1 }}</a>
            </div>
        </li>
    </ul>
</div>
<!-- This is the modal -->
<div id="my-id" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div id="modalContent"></div>
    </div>
</div>