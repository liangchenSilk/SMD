/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var SalesrepContactMethod = Class.create();
SalesrepContactMethod.prototype = {
    initialize: function (form, saveUrl) {
        this.form = form;
        if ($(this.form)) {
            $(this.form).observe('submit', function (event) {
                this.save();
                Event.stop(event);
            }.bind(this));
        }
        this.saveUrl = saveUrl;
        this.validator = new Validation(this.form);
        this.onSave = this.nextStep.bindAsEventListener(this);
        this.onComplete = this.resetLoadWaiting.bindAsEventListener(this);
    },
    validate: function () {
        if (!this.validator.validate()) {
            return false;
        }
        return true;
    },
    save: function () {

        if (checkout.loadWaiting != false)
            return;
        if (this.validate()) {
            checkout.setLoadWaiting('salesrep_contact');
            var request = new Ajax.Request(
                    this.saveUrl,
                    {
                        method: 'post',
                        onComplete: this.onComplete,
                        onSuccess: this.onSave,
                        onFailure: checkout.ajaxFailure.bind(checkout),
                        parameters: Form.serialize(this.form)
                    }
            );
        }
    },
    resetLoadWaiting: function (transport) {
        checkout.setLoadWaiting(false);
    },
    nextStep: function (transport) {
        if (transport && transport.responseText) {
            try {
                response = eval('(' + transport.responseText + ')');
            }
            catch (e) {
                response = {};
            }
        }

        if (response.error) {
            alert(response.message);
            return false;
        }

        if (response.update_section) {
            for (i = 0; i < response.update_section.length; i++) {
                $('checkout-' + response.update_section[i].name + '-load').update(response.update_section[i].html);
            }

        }

        if (response.goto_section) {
            checkout.gotoSection(response.goto_section, true);
            checkout.reloadProgressBlock('salesrep_contact');
            return;
        }

        checkout.setPayment();
    }
}