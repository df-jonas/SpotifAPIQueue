$(document).ready(function () {
    $('#editable-search').editableSelect();

    $('#editable-search').on('keyup', function () {
        $.ajax({
            url: '/api/search',
            type: 'GET',
            data: {
                "q": $('#editable-search').val()
            },
            success: function (data) {
                $("select").empty();


            },
            error: function () {
                console.log("An error has occured.")
            }
        });
    })
});