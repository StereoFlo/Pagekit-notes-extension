$(document).ready(function(){
    Vue.http.options.emulateJSON = true;
    new Vue({
        el: "#settings",
        data: {
            config: window.$data.config,
            limit: (window.$data.config.limit) ? window.$data.config.limit : '',
            symbols: (window.$data.config.symbols) ? window.$data.config.symbols : 200,
        },
        methods: {
            save: function () {
                this.$http.post('admin/system/settings/config', { name: 'notes', config: { limit: this.limit, symbols: this.symbols} }).then(
                    function (data) {
                        this.$notify(data.data.message);
                    }).catch(function (data) {
                    this.$notify(data.data.message, 'warning');
                });
            }
        }
    });
});