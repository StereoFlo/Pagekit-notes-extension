// show editor
$(document).ready(function () {
    nicEditors.allTextAreas();
});

// send data
$(document).ready(function () {
    $('#result').hide();
    $('#btnSubmit').click(function () {
        var editAction = $('#edit');
        var content = $('#form').find('.nicEdit-main').html();
        var name = $('#name').val();

        if (editAction.length > 0)
        {
            $.post(
                "/admin/notes/ajax/add",
                {data : { id : editAction.val(), name : name, content : content }}
            ).done(function (data) {
                //console.log(data);
                $('#form').hide();
                $('#result').show();
            });
        }
        else
        {
            $.post(
                "/admin/notes/ajax/add",
                {data : { id : null, name : name, content : content }}
            ).done(function (data) {
                $('#form').hide();
                $('#result').show();
            });
        }
    });
});