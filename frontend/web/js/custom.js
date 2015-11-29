$(document).on('ready', function(){
    $('#top-search').val($('#hidden-search-query').text().trim());
    //console.log($('#hidden-search-query').val())
});