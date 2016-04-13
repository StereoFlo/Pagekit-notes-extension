$(document).ready(function () {
    $('ul[data-uk-pagination]').on('select.uk.pagination', function(e, pageIndex){
        alert('You have selected page: ' + (pageIndex+1));
    });
});