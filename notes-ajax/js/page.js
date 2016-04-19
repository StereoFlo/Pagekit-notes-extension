$(document).ready(function () {
    new Vue({
        el: '#notes',
        data: {
            entries: null,
            total: null,
            page: null,
            count: null
        },

        created: function () {
            this.getNotes()
        },

        methods: {
            remove: function(entry) {
                this.$http.post('/admin/notes/ajax/delete', { data: { id : entry.id } }).then(
                    function (data) {
                        this.$notify(data.data.message);
                        this.entries.$remove(entry);
                    }).catch(
                    function (data) {
                        this.$notify(data.data.message, 'warning');
                        console.log(data);
                 });
            },
            getNotes: function (page) {
                var p = isNaN(page) ? '' : '/' + page;
                this.$http.get('/admin/notes/page/ajax/notes' + p).then(function (data) {
                    this.entries = data.data.notes;
                    this.total = data.data.total;
                    this.page = data.data.page;
                    this.count = data.data.count;
                }).catch(function (data) {
                    alert('sorry, see console log');
                    console.log(data)
                });

            }
        }
    });
});