//Add a row
function addRow(rowClass) {
    var html = $('.' + rowClass).last().html();
    var rowId = parseInt($(html).find('.remove-item').first().attr('data-row'), 10) + 1;

    var item = document.createElement('div');
    item.setAttribute('class', 'row ' + rowClass);
    item.innerHTML = html;

    //If there are any values in any input or textarea, reset them.
    $(item).find('input, select, span').each(function (key, element) {
        $(element).val('');

        if ($(element).hasClass('id')) {
            $(element).remove();
        }

        //Change the ID display
        if ($(element).hasClass('disabled')) {
            $(element).html('NEW');
        }
        //Make the remove button usable again
        else if ($(element).hasClass('remove-item') && $(element).hasClass('btn-secondary')) {
            $(element).removeClass('btn-secondary').addClass('btn-danger');
        }
    });

    return item;
}

//Remove a row
function removeRow(element, rowClass) {
    var parent = $(element).parents('.' + rowClass);
    var id = $(parent).find('.id').first().val();
    console.log(parent, id);

    //Make sure the ID is defined. Newly added rows won't have an ID
    if (typeof id !== 'undefined') {
        var deleteIds = [];
        if (document.getElementById('delete').value.length) {
            deleteIds = document.getElementById('delete').value.split(',');
        }

        deleteIds.push(id);
        document.getElementById('delete').value = deleteIds.join(',');
    }

    $(parent).remove();

    //Hide the remove button if there is only one item in the list
    if (!($('.' + rowClass).length > 1)) {
        $('.' + rowClass + ' .remove-item').addClass('d-none');
        $('.' + rowClass + ' .sort-item').addClass('d-none');
    }
}

//Rename the rows so they are sequential
function renameRows(parentClass) {
    //Iterate through children and renumber them
    $('.' + parentClass + ' > div').each(function (key, element) {
        //Set the correct id on the remove button
        $(element).find('.remove-item').first().attr('data-row', key);

        //Iterate through each of the elements and rename them
        $(element).find('input, select, textarea').each(function (inputKey, input) {
            //Change the input elements
            if ($(input).is('[name]')) {
                var name = $(input).attr('name').replace(/\[[\d]+\]/ig, '[' + key + ']');
                $(input).attr('name', name);
            }

            if ($(input).is('[id]')) {
                var id = $(input).attr('id').replace(/\-[\d]+/ig, '-' + key);
                $(input).attr('id', id);
            }
        });
    });
}
