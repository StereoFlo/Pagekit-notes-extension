<?php $view->script('contact', 'contact:js/settings.js', 'vue') ?>

<div id="settings" class="uk-form uk-form-horizontal">
    <div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
        <div data-uk-margin>
            <h2 class="uk-margin-remove">{{ 'Settings page' | trans }}</h2>
        </div>
    </div>

    <div class="uk-form-row">
        <label class="uk-form-label">{{'From name' | trans}}</label>
        <div class="uk-form-controls">
            <input type="text" v-model="from">
        </div>
    </div>
	<div class="uk-form-row">
        <label class="uk-form-label">Email</label>
        <div class="uk-form-controls">
            <input type="text" v-model="email">
        </div>
    </div>
    <div class="uk-form-row">
        <button class="uk-button uk-button-primary" @click="save">{{'Save' | trans}}</button>
    </div>
</div>
