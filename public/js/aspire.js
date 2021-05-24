var myErrorClass = 'text-danger';
let Aspire = {
    ajax_default_variable: {
        error: function (data, textStatus, errorThrown) {
            if (this.ajax_target_element === '') {
                return false;
            }
            Aspire.hideProgress(this.ajax_target_element);

            $(this.ajax_target_element).data('ajax_let', this);
            this.mySuccess();
            var errorsArray = Aspire.handleJsonOutput(data).errors;
            Aspire.clearPreviousErrors();
            var errorIdsArray = [];
            Aspire.extractErrorIds(errorsArray, errorIdsArray);
            var errorDiv = '#successMessage';
            $(errorDiv).empty();

            Aspire.appendErrorToId(errorIdsArray, errorsArray);
            Aspire.displayErrors(errorIdsArray);
        },
        ajax_target_element: '',
        beforeSend: function () {
            if (this.ajax_target_element !== '') {
                Aspire.showProgress(this.ajax_target_element);
            }
        },
        timeout: 180000,
        mySuccess: function () {
            if (this.ajax_target_element !== '') {
                $(this.ajax_target_element).removeData('ajax_let');
                if (!this.overwrite_container) {
                    this.ajax_target_element.parentElement.style.position = 'static';

                    try {
                        this.ajax_target_element.remove();
                    }
                    catch(err) {
                        try{
                            this.ajax_target_element.parentNode.removeChild(this.ajax_target_element);
                        }catch(err) {}
                    }

                }
            }
        },
        overwrite_container: true,
        success: function (response) {
            this.mySuccess();
        },
        type: 'GET',
        /* dataType:'json',*/
        cache: false
    },
    Ajax: function (input) {
        Aspire.ajaxInput = input;
        if (typeof input.overwrite_container != 'undefined' && !input.overwrite_container && typeof input.ajax_target_element != 'undefined' && input.ajax_target_element!="") {
            $(input.ajax_target_element).css("position", "relative");
            let new_target_element = Aspire.drawTransparentBlockUI();
            input.ajax_target_element.appendChild(new_target_element);
            input.ajax_target_element = new_target_element;
        }
        let default_settings = $.extend({}, Aspire.ajax_default_variable);

        return $.ajax($.extend(default_settings, input));
    },
    drawTransparentBlockUI: function () {
        let div = document.createElement("div");
        div.className = "text-center";
        div.style.background = "rgba(255,255,255, 0.5)";
        div.style.position = "absolute";
        div.style.left = "0";
        div.style.top = "0";
        div.style.width = "100%";
        div.style.height = "100%";
        return div;
    },
    hideProgress: function (targetElement) {
        $(targetElement).find('.common_loading').remove();
    },
    showProgress: function (targetElement,) {
        let height = Aspire.calculateHeightForMargin(targetElement, 85);
        let message_html = '<div class="common_loading text-center margin-10" style="margin-top:' + height + 'px"><img src="/img/ajax-loader.svg"/> </div>';
        $(targetElement).html(message_html);
    },
    calculateHeightForMargin: function (targetElement, min_height, default_height) {
        if (typeof default_height == 'undefined') {
            default_height = 0;
        }

        let element_height = $(targetElement).height();
        let height = default_height;
        if (element_height > min_height) {
            height = ( element_height - min_height ) / 2;
        }
        return height;
    },
    handleJsonOutput: function (data) {

        try {
            return jQuery.parseJSON(data.responseText);
        }
        catch (err) {
            console.log("For some reason, we're not able to validate this request automatically. Please click 'Ok' for us to try again using another method.");
        }
    },
    clearPreviousErrors: function () {
        $('.' + myErrorClass).html("");
        $('input').removeClass('ajax-error');
    },
    extractErrorIds: function (errorsArray, errorIdsArray) {
        for (var key in errorsArray) {
            if (!errorsArray.hasOwnProperty(key)) {
                continue;
            }
            errorIdsArray.push(key);
        }
    },

    appendErrorToId: function (errorIdsArray, errorsArray) {
        for (var i = 0; i < errorIdsArray.length; i++) {
            var errorDiv = Aspire.getErrorDiv(errorIdsArray[i]);
            for (var j = 0; j < 1; j++) {
                var error_message = errorsArray[errorIdsArray[i]][j];

                if (!$(errorDiv).length) {
                    console.log("Could not find a container '" + errorDiv + "' to display the error message: " + error_message);
                }
                else {
                    $(errorDiv).append(error_message);
                }

            }
        }
    },
    getErrorDiv: function (errorId) {
        var new_error_id = errorId.replace(/\./g, '\\\\.');
        var string_to_select = eval("'#"+new_error_id+"'");
        var errorDiv = $(string_to_select).attr('data-validation-error-msg-container');
        if (errorDiv) {
            return errorDiv;
        }
        else {
            console.log("Could not find a validation-error-msg-container for the id " + new_error_id);
            return "default-error-container";
        }
    },
    displayErrors: function (errorIdsArray) {
        $('.' + myErrorClass).css('display', 'inline');
        for (var i = 0; i < errorIdsArray.length; i++) {
            var new_error_id = errorIdsArray[i].replace(/\./g, '\\\\.');
            var string_to_select = eval("'#"+new_error_id+"'");
            $(string_to_select).addClass('ajax-error');
        }
    },


}

