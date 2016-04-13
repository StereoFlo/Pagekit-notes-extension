<?php $view->script('contact', 'contact:js/contact.js', 'vue') ?>

<div id="sendForm">
    <h2>{{ 'Send a feedback' | trans }}</h2>
    <div class="uk-form-row">
         <label for="form-name" class="uk-form-label">{{ 'Name' | trans }}</label>
         <div class="uk-form-controls">
             <input id="form-name" class="uk-form-width-large" type="text" v-model="name">
         </div>
     </div>
    <div class="uk-form-row">
         <label for="form-email" class="uk-form-label">Email</label>
         <div class="uk-form-controls">
             <input id="form-email" class="uk-form-width-large" type="email" v-model="email">
         </div>
     </div>
    <div class="uk-form-row">
        <label for="form-message" class="uk-form-label">{{'You message'|trans}}</label>
        <div class="uk-form-controls">
            <textarea id="form-message" class="uk-form-width-large" v-model="message" rows="10"></textarea
        </div>
    </div>
    <p>
        <button class="uk-button uk-button-primary" type="submit" accesskey="s" @click="send">{{'Submit'|trans}}</button>
        <button class="uk-button" accesskey="c">{{'Cancel'|trans}}</button>
    </p>
</div>
