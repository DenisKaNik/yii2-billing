let project = { modules: [] };

project.extend = function(moduleName, moduleData) {
    if (!moduleName) {
        return;
    }
    if (!moduleData) {
        let moduleData = {
            elements: {},
            init: () => {
                //console.log("Empty init for module");
            }
        };
    }
    this[moduleName] = moduleData;
    this.modules.push(moduleData);
    return moduleData;
};

project.init = function() {
    let totalModules = project.modules.length;
    for (let k = 0; k < totalModules; k++) {
        project.modules[k].init();
    }
};

project.extend("common", {
    init: function() {
        let self = this;

        $('.number').inputmask('Regex', {regex: "^[0-9]{1,4}$"});
        $('.decimal').inputmask('Regex', {regex: "^[0-9]{1,4}(\\.\\d{1,2})?$"});
        $('.phone').inputmask({"mask":"9999999999"});

        $("[data-action='MEMBER-SAVE']").on('click', function(){
            self.memberSave($(this).parents('form'));
        });

        $("[data-action='MEMBER-STATUS']").on('click', function(){
            self.memberStatus($(this).attr('data-value'), $(this).attr('data-status'));
        });

        $("[data-action='REFILL-BALANCE']").on('click', function(){
            self.refillBalance($(this).parents('form'));
        });
    },

    memberSave: function(form) {
        $.ajax({
            url: '/member',
            type: "POST",
            data: new FormData(form[0]),
            contentType: false,
            dataType: "json",
            processData: false,
            cache: false,
            success: function(data) {
                if (data.success) {
                    document.location.reload();
                }
            },
            error: function(data) {
                if (data.responseJSON) {
                    if (data.responseJSON.errors !== undefined) {
                        $.each(data.responseJSON.errors, function(field, val) {
                            let input = $('.field-memberform-' + field);
                            if (input.length) {
                                input.addClass('has-error')
                                    .find('.help-block').text(val[0]);
                            }
                        });
                    }
                }
            }
        });

        return false;
    },

    memberStatus: function (id, status) {
        $.ajax({
            url: '/member-status/' + id + '/' + status,
            type: "PUT",
            contentType: false,
            dataType: "json",
            processData: false,
            cache: false,
            success: function(data) {
                $('tr[data-key="' + id + '"]').find("[data-action='MEMBER-STATUS']").toggle();
            },
            error: function(data) {
                //
            }
        });

        return false;
    },

    refillBalance: function(form) {
        $.ajax({
            url: '/refill-balance',
            type: "POST",
            data: new FormData(form[0]),
            contentType: false,
            dataType: "json",
            processData: false,
            cache: false,
            success: function(data) {
                $('#modalRefillBalance')
                    .find('.btn-close_modal').click()
                    .end()
                    .find('form')[0].reset();

                if (data.success) {
                    $('tr[data-key="' + data.id + '"]').find(".cell-balance").text(data.balance);
                }
            },
            error: function(data) {
                if (data.responseJSON) {
                    if (data.responseJSON.errors !== undefined) {
                        $('.field-refillbalanceform-error').find('.help-block').text('');

                        $.each(data.responseJSON.errors, function(field, val) {
                            let input = $('.field-refillbalanceform-' + field);
                            if (input.length) {
                                input.addClass('has-error')
                                    .find('.help-block').text(val[0]);
                            }
                        });
                    }
                }
            }
        });

        return false;
    },

});

$(project.init);
