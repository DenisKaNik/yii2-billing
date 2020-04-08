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

        $("[data-action='GENERATE-REPORT']").on('click', function(){
            self.generateReport($(this).parents('form'));
        });

        $("[data-action='REFILL_BALANCE-CANCEL']").on('click', function(){
            self.refillBalanceCancel($(this).attr('data-value'));
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
        $('.has-error')
            .removeClass('has-error')
            .find('.help-block').text('');

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

    generateReport: function(form) {
        $('.has-error')
            .removeClass('has-error')
            .find('.help-block').text('');

        $.ajax({
            url: '/refill-balance/report',
            type: "POST",
            data: new FormData(form[0]),
            contentType: false,
            dataType: "json",
            processData: false,
            cache: false,
            success: function(data) {
                if (data.success && data.redirect_url) {
                    document.location.href = data.redirect_url;
                }
            },
            error: function(data) {
                if (data.responseJSON) {
                    if (data.responseJSON.errors !== undefined) {
                        $.each(data.responseJSON.errors, function(field, val) {
                            let fieldForm = $('.field-reportform-' + field);
                            if (fieldForm.length) {
                                fieldForm.addClass('has-error')
                                    .find('.help-block').text(val[0]);
                            }
                        });
                    }
                }
            }
        });

        return false;
    },

    refillBalanceCancel: function (id) {
        $.ajax({
            url: '/refill-balance/' + id + '/cancel',
            type: "PUT",
            contentType: false,
            dataType: "json",
            processData: false,
            cache: false,
            success: function(data) {
                if (data.success) {
                    let $tr = $('tr[data-key="' + id + '"]'),
                        $total = $('.totalSum');

                    $tr
                        .find('.cell-sum').html(data.sum ? '<s>' + data.sum + '</s>' : '')
                        .end()
                        .find('.cell-status').html(data.statusLabel)
                        .end()
                        .find('.cell-btn_cancel button').remove();

                    $total.text(parseFloat($total.text()) - parseFloat(data.sum ?? 0));
                }

            },
            error: function(data) {
                //
            }
        });

        return false;
    }

});

$(project.init);
