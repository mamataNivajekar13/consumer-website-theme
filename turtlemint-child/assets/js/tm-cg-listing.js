$(document).ready(function () {
    var table = $('#garage-table').DataTable({
        "dom": '<"top"i>rt<"bottom"flp><"clear">',
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 75, 100],
        ordering: false,
        language: {
            emptyTable: "No results match",
            infoEmpty: "Showing _START_ to _END_ of _TOTAL_ garage results",
            infoFiltered: "(filtered from _MAX_ total garage results)",
            zeroRecords: '<div id="no-results" style="padding: 35px 0;"><div class="no-results-content"><i class="tm-sprite-2 bg-search-2"></i><p class="mb-0 mt-4">No results match <span class=\"typed-string\"></span>.</p></div></div>',
            paginate: {
                next: '<i class="tm-sprite-3 bg-chevron-right"></i>',
                previous: '<i class="tm-sprite-3 bg-chevron-right"></i>'
            },
            "info": "Showing _START_ to _END_ of _TOTAL_ garage results in <span class=\"city-name\"></span>"
        }
    });

    // Custom search input event
    $('#customSearch').on('keyup', function () {
        $('#garage-table').DataTable().search($(this).val()).draw();
    });

    table.on('draw.dt', function () {
        var typedString = table.search();
        $('.typed-string').text(`"${typedString}"`);
        var remainingRowCount = table.rows({ search: 'applied' }).count();
        $(".h-count").text(remainingRowCount);
        var city_name = $('.c-name').text();
        $('.city-name').text(`${city_name}`);
    });

    table.on('page.dt', function () {
        $('html, body').animate({
            scrollTop: $("#customSearch").offset().top - 20
        }, 'slow');
    });

    var city_name = $('.c-name').text();
    $('.city-name').text(`${city_name}`);
});