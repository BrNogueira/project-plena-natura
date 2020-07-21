const checkout = {
    data: {},
    canSubmit: false,

    init: function () {
        window.Mercadopago.setPublishableKey("TEST-d9f0fb40-8750-466e-a3f4-c0adce62137f");

        $('#card_number').on('keyup', this.guessPaymentMethod);
        $('#card_number').on('change', this.guessPaymentMethod);

        // Masks
        $('#docNumber').mask('000.000.000-00');
        $('#birth_date').mask('00/00/0000');
        $('#card_number').mask('0000 0000 0000 0000');
        $('#ccv').mask('0000');
        $('#cel').mask('(00) 00000-0000');
        $('#phone').mask('(00) 0000-0000');

        $('#submitCheckout').on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();

            checkout.submit();
        });
    },
    submit: function () {
        var $form = document.querySelector('#pay');
        window.Mercadopago.createToken($form, checkout.sdkResponseHandler);
    },
    pay: function() {
        $.ajax({
            type: 'post',
            url: '/checkout/pagamento/submit',
            dataType: 'json',
            data: this.data,
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log(response);
            }
        });
    },
    setupData: function() {

        this.data.first_name = $('#first_name').val();
        this.data.last_name = $('#last_name').val();
        this.data.birth_date = $('#birth_date').val();
        this.data.gender = $('#gender').val();
        this.data.password = $('#password').val();
        this.data.confirmPassword = $('#confirmPassword').val();
        this.data.email = $('#email').val();
        this.data.cpf = $("#docNumber").val();
        this.data.installments = $("#installments").val();
        this.data._token = $('meta[name="csrf-token"]').attr('content');

        // Shipping
        this.data.shipping = {};

        this.data.shipping.zipcode = $('input[name="shipping_zipcode"]').val();
        this.data.shipping.street = $('input[name="shipping_street"]').val();
        this.data.shipping.number = $('input[name="shipping_number"]').val();
        this.data.shipping.address2 = $('input[name="shipping_address2"]').val();
        this.data.shipping.neighborhood = $('input[name="shipping_neighborhood"]').val();
        this.data.shipping.city = $('input[name="shipping_city"]').val();
        this.data.shipping.state = $('input[name="shipping_state"]').val();
        this.data.shipping.phone = $('input[name="shipping_phone"]').val();
        this.data.shipping.cellphone = $('input[name="shipping_cellphone"]').val();

    },
    guessPaymentMethod: function (event) {
        let cardnumber = $("#card_number").val();

        if (cardnumber.length >= 6) {
            let bin = cardnumber.substring(0,6);
            window.Mercadopago.getPaymentMethod({
                "bin": bin
            }, checkout.setPaymentMethod);
        }
    },
    setPaymentMethod: function(status, response) {
        if (status === 200) {
            let paymentMethodId = response[0].id;
            $('#payment_method_id').val(paymentMethodId);

            checkout.data.payment_method_id = paymentMethodId;

            checkout.getInstallments();
        } else {
            alert(`Erro ao verificar bandeira do cartão: ${response.cause.description}`);
        }
    },
    getInstallments: function () {
        window.Mercadopago.getInstallments({
            "payment_method_id": document.getElementById('payment_method_id').value,
            "amount": parseFloat(document.getElementById('transaction_amount').value)

        }, function (status, response) {
            if (status === 200) {
                document.getElementById('installments').options.length = 0;
                response[0].payer_costs.forEach( installment => {
                    let opt = document.createElement('option');
                    opt.text = installment.recommended_message;
                    opt.value = installment.installments;
                    document.getElementById('installments').appendChild(opt);
                });
            } else {
                alert(`Erro ao carregar parcelas: ${response}`);
            }
        });
    },
    sdkResponseHandler: function(status, response) {

        // console.log(status, response);

        // if (status != 200 && status != 201) {
        //     if(response.status === 400) {
        //         alert("Por favor, atualize a página e tente novamente.");
        //     } else {
        //         alert("Por favor, verifique os dados preenchidos.");
        //     }

        //     this.canSubmit = false;
        //     return false;
        // } else {
            var form = document.querySelector('#pay');
            var card = document.createElement('input');
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', response.id);
            form.appendChild(card);

            checkout.data.token = response.id;

            checkout.canSubmit = true;

            checkout.setupData();
            checkout.pay();

        // }
    },
    calculateShipping: function() {
        
    }
}

checkout.init();
