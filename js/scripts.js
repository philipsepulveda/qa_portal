// Empty JS for your own code to be here

$(document).ready(function () {
    $('div > a').click(function() {
        var x = $(this).attr("id");
        $(this).attr("name", x);

        // TODO: insert whatever you want to do with $(this) here
    });
})

function displaySearchResults(x){
    alert("Yeah! " +$(this).attr("id"));
    $('tbody').attr("name", x);
}