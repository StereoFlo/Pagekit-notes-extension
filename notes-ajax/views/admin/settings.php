<?php $view->script('notes', 'notes:js/settings.js', 'vue') ?>

<div id="settings" class="uk-form uk-form-horizontal">
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>
            <h2 class="uk-margin-remove">{{ 'Settings page' | trans }}</h2>
        </div>
    </div>

    <div class="uk-form-row">
        <label class="uk-form-label">{{ 'Notes on page' | trans }}</label>
        <div class="uk-form-controls">
            <input type="text" v-model="limit">
        </div>
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label">{{ 'How many symbols are shown on the list page?' | trans }}</label>
        <div class="uk-form-controls">
            <input type="text" v-model="symbols">
        </div>
    </div>
    <div class="uk-form-row">
        <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
    </div>
</div>
