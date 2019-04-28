//Add a row
function addRow(rowClass) {
    var html = $('.' + rowClass).last().html();

    var item = document.createElement('div');
    item.setAttribute('class', 'form-row ' + rowClass);
    item.innerHTML = html;

    //If there are any values in any input or textarea, reset them.
    $(item).find('input, select, span, label, textarea').each(function (key, element) {
        //If we're specifying the type, like on files or photos, leave the value
        if ($(element).hasClass('type')) {
            return;
        }

        $(element).val('');

        if ($(element).hasClass('id') || $(element).hasClass('path')) {
            $(element).remove();
            return;
        }

        //Change the ID display
        if ($(element).is('[disabled]')) {
            $(element).removeAttr('disabled');
        }
        if ($(element).hasClass('custom-file-label')) {
            $(element).html('Add Photo (Optional)')
        }
        //Make the remove button usable again
        else if ($(element).hasClass('remove-item') && $(element).hasClass('btn-secondary')) {
            $(element).removeClass('btn-secondary').addClass('btn-danger');
        }
    });

    return item;
}

//Remove a row
function removeRow(element, rowClass, parentClass) {
    //If we're removing the last row, make sure to add a fresh one in
    if ($('.' + rowClass).length < 2) {
        $('.' + parentClass).append(addRow(rowClass));
    }

    var parent = $(element).parents('.' + rowClass);
    var id = $(parent).find('.id').first().val();

    //Make sure the ID is defined. Newly added rows won't have an ID
    if (typeof id !== 'undefined') {
        var deleteIds = [];
        if (document.getElementById('delete-' + rowClass).value.length) {
            deleteIds = document.getElementById('delete-' + rowClass).value.split(',');
        }

        deleteIds.push(id);
        document.getElementById('delete-' + rowClass).value = deleteIds.join(',');
    }

    $(parent).remove();
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

            if ($(input).hasClass('order-number')) {
                $(input).attr('value', key + 1);
            }

            if ($(input).is('[id]')) {
                var id = $(input).attr('id').replace(/\-[\d]+/ig, '-' + key);
                $(input).attr('id', id);
            }
        });
    });
}
