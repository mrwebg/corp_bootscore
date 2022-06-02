(function ($) {
    /****************************************************
     *
     * Conditional Logic
     *
     ***************************************************/

    function CMB2Conditional() {
        $('[data-conditional-id]').each((i, el) => {
            let condName = el.dataset.conditionalId,
                condValue = el.dataset.conditionalValue,
                condParent = el.closest('.cmb-row'),
                inGroup = condParent.classList.contains('cmb-repeat-group-field');
            // Check if the field is in group
            if (inGroup) {
                let groupID = condParent.closest('.cmb-repeatable-group').getAttribute('data-groupid'),
                    iterator = condParent.closest('.cmb-repeatable-grouping').getAttribute('data-iterator');

                // change the select name with group ID added
                condName = `${groupID}[${iterator}][${condName}]`;
            }

            // Check if value is matching
            function valueMatch(value) {
                return condValue.includes(value) && value !== '';
            }

            // Select the field by name and loob through
            $('[name="' + condName + '"]').each(function (i, field) {
                // Select field
                if ('select-one' === field.type) {
                    if (!valueMatch(field.value)) $(condParent).hide();

                    // Check on change
                    $(field).on('change', function (event) {
                        valueMatch(event.target.value) ? $(condParent).show() : $(condParent).hide();
                    });
                }

                // Radio field
                else if ('radio' === field.type) {
                    // Hide the row if the value doesn't match and not checked
                    if (!valueMatch(field.value) && field.checked) {
                        $(condParent).hide();
                    }

                    // Check on change
                    $(field).on('change', function (event) {
                        valueMatch(event.target.value) ? $(condParent).show() : $(condParent).hide();
                    });
                }

                // Checkbox field
                else if ('checkbox' === field.type) {
                    // Hide the row if the value doesn't match and not checked
                    if (!field.checked) $(condParent).hide();

                    // Check on change
                    $(field).on('change', function (event) {
                        event.target.checked ? $(condParent).show() : $(condParent).hide();
                    });
                }
            });
        });
    }

    // Trigger the funtion
    CMB2Conditional();

    // Trigger again when new group added
    $('.cmb2-wrap > .cmb2-metabox').on('cmb2_add_row', function () {
        CMB2Conditional();
    });

    /**************************************************************
     *
     * TABS
     *
     *************************************************************/

    // Initial check
    if ($('.cmb-tabs').length) {
        $('.cmb-tabs').each(function () {
            // Activate first tab
            if (!$(this).find('.cmb-tab.active').length) {
                $(this).find('.cmb-tab').first().addClass('active');

                $($(this).find('.cmb-tab').first().data('fields')).addClass('cmb-tab-active-item');

                // Support for groups and repeatable fields
                $($(this).find('.cmb-tab').first().data('fields')).find('.cmb-repeat .cmb-row, .cmb-repeatable-group .cmb-row').addClass('cmb-tab-active-item');
            }
        });
    }

    $('body').on('click.cmbTabs', '.cmb-tabs .cmb-tab', function (e) {
        var tab = $(this);

        if (!tab.hasClass('active')) {
            var tabs = tab.closest('.cmb-tabs');
            var form = tabs.next('.cmb2-wrap');

            // Hide current active tab fields
            form.find(tabs.find('.cmb-tab.active').data('fields')).fadeOut(0, function () {
                $(this).removeClass('cmb-tab-active-item');

                form.find(tab.data('fields')).fadeIn(0, function () {
                    $(this).addClass('cmb-tab-active-item');

                    // Support for groups and repeatable fields
                    $(this).find('.cmb-repeat-table .cmb-row, .cmb-repeatable-group .cmb-row').addClass('cmb-tab-active-item');
                });
            });

            // Update tab active class
            tabs.find('.cmb-tab.active').removeClass('active');
            tab.addClass('active');
        }

        CMB2Conditional();
    });

    // Adding a new group element needs to get the active class also
    $('body').on('click', '.cmb-add-group-row', function () {
        $(this).closest('.cmb-repeatable-group').find('.cmb-row').addClass('cmb-tab-active-item');
    });

    // Adding a new repeatable element needs to get the active class also
    $('body').on('click', '.cmb-add-row-button', function () {
        $(this).closest('.cmb-repeat').find('.cmb-row').addClass('cmb-tab-active-item');
    });

    // Initialize on widgets area
    $(document).on('widget-updated widget-added', function (e, widget) {
        if (widget.find('.cmb-tabs').length) {
            widget.find('.cmb-tabs').each(function () {
                // Activate first tab
                if (!$(this).find('.cmb-tab.active').length) {
                    $(this).find('.cmb-tab').first().addClass('active');

                    $($(this).find('.cmb-tab').first().data('fields')).addClass('cmb-tab-active-item');

                    // Support for groups and repeatable fields
                    $($(this).find('.cmb-tab').first().data('fields')).find('.cmb-repeat .cmb-row, .cmb-repeatable-group .cmb-row').addClass('cmb-tab-active-item');
                }
            });
        }
    });

    // Replace group titles on FAQ input
    var $box = $(document.getElementsByClassName('cmb2-postbox'));

    var replaceTitles = function () {
        $box.find('.cmb-group-title').each(function () {
            var $this = $(this);
            var txt = $this.next().find('[id$="question"]').val();
            var rowindex;

            if (!txt) {
                txt = $box.find('[data-grouptitle]').data('grouptitle');
                if (txt) {
                    rowindex = $this.parents('[data-iterator]').data('iterator');
                    txt = txt.replace('{#}', rowindex + 1);
                }
            }

            if (txt) {
                $this.text(txt);
            }
        });
    };

    var replaceOnKeyUp = function (evt) {
        var $this = $(evt.target);
        var id = 'question';

        if (evt.target.id.indexOf(id, evt.target.id.length - id.length) !== -1) {
            $this.parents('.cmb-row.cmb-repeatable-grouping').find('.cmb-group-title').text($this.val());
        }
    };

    $box.on('cmb2_add_row cmb2_remove_row cmb2_shift_rows_complete', replaceTitles).on('keyup', replaceOnKeyUp);

    replaceTitles();
})(jQuery);
