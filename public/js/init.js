"use strict";
var table = $('.table');
table.on('change', '.group-checkable', function() {
    var set = $(this).closest('table').find('td:first-child .checkable');
    var checked = $(this).is(':checked');

    $(set).each(function() {
        if (checked) {
            $(this).prop('checked', true);
            $(this).closest('tr').addClass('active');
        }
        else {
            $(this).prop('checked', false);
            $(this).closest('tr').removeClass('active');
        }
    });
});

table.on('change', 'tbody tr .checkbox', function() {
    $(this).parents('tr').toggleClass('active');
});

table.on('change', '.group-checkable, .checkable', function() {
    if ($('.checkable').is(':checked')) {
        $('.btn-bulk-delete').show();
    } else {
        $('.btn-bulk-delete').hide();
    }
});