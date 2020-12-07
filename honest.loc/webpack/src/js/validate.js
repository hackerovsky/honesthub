import 'jquery-validation';
import $ from "jquery";

window.addEventListener('DOMContentLoaded', e => {
    //  Заказать звонок
    function sendCall() {
        var surname = $("input[name*='surname_call']").val();
        var phone = $("input[name*='phone_call']").val();
        var select = $("select[name*='select_call']").val();
        var text = $("textarea[name*='text_call']").val();

            $.ajax({
                url:'/call.php',
                type: 'post',
                data: {
                    'name': surname,
                    'phone': phone,
                    'select': select,
                    'text': text,
                },
                success: function (data) {
                    $('#success').modal();
                    $('#success div').html(data);
                    document.getElementById('send-call').reset();
                }
            })
    }

    //уведомить
    function sendRipart() {
        var ripart = $("input[name*='ripart']").val();

        $.ajax({
            url: '/ripart.php',
            type: 'post',
            data: {
                'ripart': ripart,
            },
            success: function (data) {
                $('#success').modal();
                $('#success div').html(data);
                document.getElementById('send-ripart').reset();
            },
        });
    }

    //Отправить вопрос
    function sendQuastion() {
        var name = $("input[name*='name']").val();
        var email = $("input[name*='email']").val();
        var quastion = $("textarea[name*='quastion']").val();

        $.ajax({
            url: '/quastion.php',
            type: 'post',
            data: {
                'name': name,
                'email': email,
                'quastion': quastion,
            },
            success: function (data) {
                $('#success').modal();
                $('#success div').html(data);
                document.getElementById('quastion-form').reset();
            },
        });
    }

    let regexEmail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
    let regexPhone = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i;

    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            return this.optional(element) || regexp.test(value);
        },
    );

    $('#send-ripart').validate({
            rules: {
                ripart: {
                    required: true,
                    regex: regexEmail,
                }
            },
            messages: {
                ripart: {
                    required: "Обязательное поле",
                    regex: "Введите E-mail в формате: example@mail.ru",
                },
            },
            submitHandler: function () {
                sendRipart();
                return false;
            }
        });

    $('#quastion-form').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                regex: regexEmail,
            },
            quastion: {
                required: true,
            },
            policy: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Обязательное поле",
            },
            email: {
                required: "Обязательное поле",
                regex: "Введите E-mail в формате: example@mail.ru",
            },
            quastion: {
                required: "Обязательное поле",
            },
        },
        submitHandler: function () {
            sendQuastion();
            return false;
        }
    });

    $('#send-call').validate({
        rules: {
            surname_call: {
                required: true,
            },
            phone_call: {
                required: true,
                regex:regexPhone,
            },
            select_call: {
                required: true,
            },
            text_call: {
                required: false,
            },
            policy: {
                required: true,
            },
        },
        messages: {
            surname_call: {
                required: "Обязательное поле",
            },
            phone_call: {
                required: "Обязательное поле",
                regex: "Введите корректный номер телефона"
            },
            select_call: {
                required: "Обязательное поле",
            },
        },
        submitHandler: function () {
            sendCall();
            return false;
        }
    });

});
