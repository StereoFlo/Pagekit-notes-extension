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
                this.$http.post('/api/notes/ajax/delete', { data: { id : entry.id } }).then(
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
                this.$http.get('/api/notes/ajax/notes' + p).then(function (data) {
                    this.entries = data.data.notes;
                    this.total = data.data.total;
                    this.page = data.data.page;
                    this.count = data.data.count;
                }).catch(function (data) {
                    alert('sorry, see console log');
                    console.log(data)
                });
            },
            getNote: function (id) {
                var p = isNaN(id) ? '' : id;
                this.$http.get('/admin/notes/page/view/' + p).then(function (data) {
                    $('#modalContent').html(data.data);
                }).catch(function (data) {
                    alert('sorry, see console log');
                    console.log(data)
                });
            },
            editNote: function (id) {
                var p = isNaN(id) ? '' : id;
                if (p == '') {
                    this.$http.get('/admin/notes/add').then(function (data) {
                        $('#modalContent').html(data.data);
                        nicEditors.allTextAreas();
                        $('#btnSubmit').click(function () {
                            var content = $('#form').find('.nicEdit-main').html();
                            var name = $('#name').val();
                            $.post(
                                "/api/notes/ajax/add",
                                {data : { id : null, name : name, content : content }}
                            ).done(function (data) {
                                $('#form').hide();
                                $('#result').show();
                            });

                        });
                    }).catch(function (data) {
                        alert('sorry, see console log');
                        console.log(data)
                    });
                } else {
                    this.$http.get('/admin/notes/page/edit/' + p).then(function (data) {
                        $('#modalContent').html(data.data);
                        nicEditors.allTextAreas();
                        $('#btnSubmit').click(function () {
                            var editAction = $('#edit');
                            var content = $('#form').find('.nicEdit-main').html();
                            var name = $('#name').val();
                            $.post(
                                "/api/notes/ajax/add",
                                {data : { id : editAction.val(), name : name, content : content }}
                            ).done(function (data) {
                                $('#form').hide();
                                $('#result').show();
                            });

                        });
                    }).catch(function (data) {
                        alert('sorry, see console log');
                        console.log(data)
                    });
                }
            }
        }
    });
});