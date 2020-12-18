<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prep Contract for Delivery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" async="">

    <!-- jQuery UI Sunny theme -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/sunny/jquery-ui.min.css" integrity="sha512-t/yl85emxwarY4DzF8RUddWA+01SUMtURTPNve/zvFnzmor8mM2TMu2tWff/SdeXOEyrmenasu2R2/UEeDE+pw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/sunny/theme.min.css" integrity="sha512-D7I8i+5c8pBasr1IqvyTFr6wQFHKXJ9XWlij0Y3W9zBjofUcXY24dLaGJI8zLe252GhHuH6L6PvWKXGGrkA4DQ==" crossorigin="anonymous" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- jQuery UI DatePicker.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous"></script>
    <!-- jQuery UI [Has to be below DatePicker, for some reason... -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <style>
body {
    padding: 30px;
}
header div#updateSuccessful {
    position: fixed;
    top: 0;
    right: 0;
}

section.contract {
    padding: 20px 30px;
    border: 1px black solid;
    background: #F8F8F8;
    max-width: 42.5em;
    font-family: serif !important;;
    text-align: justify !important;
    white-space: pre-wrap;
}

section.contract button {
    font-family: sans-serif;
}

.popup-tag{
    position: absolute;
    display:none;
    background-color: #785448CC;
    color: white;
    padding: 10px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    -webkit-filter: drop-shadow(0 1px 10px rgba(113,158,206,0.8));
}

.popup-tag ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

input.datepicker {
    width: 8em;
    text-align: center;
}
    </style>
    <script>
        window.htmlWidgetCounts = new Map();

        // From: https://stackoverflow.com/a/48422455/430062
        function getSelected()
        {
            if (window.getSelection) {
                console.log(window.getSelection());
                return window.getSelection();
            }
            else if (document.getSelection)
            {
                console.log(document.getSelection());
                return document.getSelection();
            }
            else {
                var selection = document.selection && document.selection.createRange();
                if (selection.text) { return selection.text; }
                return false;
            }

            return false;
        }

        function recordSelectedText()
        {
            var sel, range;
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.rangeCount) {
                    recordSelectedText.range = sel.getRangeAt(0);
                }
            } else if (document.selection && document.selection.createRange) {
                recordSelectedText.range = document.selection.createRange();
                recordSelectedText.range.text = replacementText;
            }
        }

        function replaceSelectedText(replacementText) {
            if (!recordSelectedText.range) {
                return;
            }

            recordSelectedText.range.deleteContents();
            recordSelectedText.range.insertNode(document.createTextNode(replacementText));
        }

        function insertHTMLWidgets()
        {
            const replaceHTML = function(needle, html, template) {
                const $template = $(`#${template}Template`);

                while (html.search(needle) !== -1) {
                    window.htmlWidgetCounts[template] = ++window.htmlWidgetCounts[template] || 1;
                    $template.find(`input.${template}`).prop('name', template + '_' + window.htmlWidgetCounts[template]);

                    html = html.replace(needle, $template.html());
                }

                return html;
            };

            $('section#contract main').html(function(index,html) {
                $('li.replaceText').each(function (index, item) {
                    const $item = $(item);
                    const needle = $item.data('needle');
                    const fieldName = $item.data('name');

                    html = replaceHTML(new RegExp('\{\{' + needle + '\}\}', 'g'), html, fieldName);
                });

                return html;
            });
        }

        $(document).ready(function() {
            $('.replaceText').click(function () {
                replaceSelectedText('\{\{' + $(this).data('needle') + '}}');
                insertHTMLWidgets();
                $("div.popup-tag").css('display', 'none');
            });

            $('.contract').mouseup(function(event) {
                const $popupTag = $("div.popup-tag");
                const selection = $.trim(getSelected());
                const popupHeight = $popupTag.height();

                if (selection !== '') {
                    $popupTag.css("display", "block");
                    $popupTag.css("top",  event.pageY - (popupHeight / 2));
                    $popupTag.css("left", event.pageX + 50);
                } else {
                    $popupTag.css("display","none");
                }
                recordSelectedText();
            });

            $('button#deliverContract').click(function () {
                const recipientData = {
                    name:  $('input#recipient_name').val(),
                    email: $('input#recipient_email').val(),
                    city:  $('input#recipient_city').val(),
                    state: $('input#recipient_state').val(),
                };

                $('section#contractSideBySide').html($('section#contract main').clone());

                $('section#contractSideBySide *').filter(':input').each(function(index, element) {
                    let elementValue = $(element).val();

                    if (elementValue === '') {
                        elementValue = '__________________';
                    }

                    $(element).replaceWith(`<strong>${elementValue}</strong>`);
                });

                $('#updateSuccessful').addClass('d-none');
                // $.ajax({
                //     url: '/contracts-tracker/api/contract/' + $('input#contractId').val(),
                //     type: 'PUT',
                //     contentType: 'application/json',
                //     processData: false,
                //     dataType: 'json',
                //     data: JSON.stringify(contractData),
                // })
                //     .then(function (data) {
                //         $('#updateSuccessful').removeClass('d-none');
                //     })
                //     .catch(function (error) {
                //         alert(data);
                //     });
            });

            insertHTMLWidgets();
        });

        $( function() {
            $('input.datepicker').datepicker();
        } );
    </script>
</head>
<body>
@if (!$contract)
    <div class="alert alert-danger">
        <h1>Missing Contract</h1>

        The contract with the ID <strong>"{{$contractId}}"</strong> could not be found.
    </div>
@else
    <header>
        <h1>Prep The Contract For Delivery</h1>
        <p>Please edit this contract to your specifications.</p>
        <p>While the entire document is editable, we have added a popup dialogue for ease-of-use.</p>
        <p>Just select the fields you want to replace and click the desired button.</p>
        <div class="d-none alert alert-success" id="updateSuccessful">The Contract was successfully delivered.</div>
    </header>
    <section class="contract_meta">
        <form>
            <input type="hidden" id="contractId" value="{{$contractId}}"/>
            <div class="form-group">
                <label for="recipient_name"><strong>Recipient's Name</strong></label>
                <input type="text" class="form-control col-md-6" id="recipient_name" aria-describedby="emailHelp" placeholder="Recipient's name">
            </div>
            <div class="form-group">
                <label for="recipient_email"><strong>Recipient's Email</strong></label>
                <input type="text" class="form-control col-md-6" id="recipient_email" placeholder="Recipient's email">
            </div>
            <div class="form-group">
                <div class="row col-md-12" style="margin-left: -30px">
                    <div class="col-md-3">
                        <label for="recipient_city"><strong>Recipient's City</strong></label>
                        <input type="text" class="col-md-11" id="recipient_city" placeholder="Recipient's city">
                    </div>
                    <div class="col-md-2">
                        <label for="recipient_state"><strong>State</strong></label><br/>
                        <input type="text" class="col-md-4" id="recipient_state" placeholder="NY">
                    </div>
                </div>
            </div>
        </form>
    </section>
    <button class="btn btn-primary" id="deliverContract">Deliver Contract</button>

    {{--    <div id=”calendar”></div>--}}
    <div id="htmlTemplates" class="d-none">
        <span id="datepickerTemplate"><label><input type="text" class="datepicker" min="<?php echo date('Y-m-d'); ?>" autocomplete="off" placeholder="MM/DD/YYYY" /></label></span>
        <span id="applicantNameTemplate"><label><input type="text" class="applicantName" placeholder="Your Full Name" /></label></span>
        <span id="applicantSignatureTemplate"><label><input type="submit" class="applicantSignature" placeholder="Your Full Name" /></label></span>
        <span id="corporateSignatureTemplate"><label><input type="submit" class="corporateSignature" placeholder="Your Full Name" /></label></span>
        <span id="corporateNameTemplate"><label><input type="text" class="corporateName" placeholder="Corporation's Name" /></label></span>
        <span id="corporateRepTemplate"><label><input type="text" class="corporateRep" placeholder="Corp Rep's Full Name" /></label></span>
        <span id="corporateTitleTemplate"><label><input type="text" class="corporateTitle" placeholder="Corp Rep's Title" /></label></span>
    </div>

    <div class="row">
    <section id="contract" class="contract col-md-6"><main>{!! $contractText !!}</main></section>
{{--    <section class="contract col-md-6" id="contractSideBySide">--}}
    <section id="contractSideBySide" class="contract col-md-6">
    </section>
    </div>
    <button class="btn btn-primary" id="deliverContract">Deliver Contract</button>
    <div class="popup-tag" style="font-family: sans-serif; font-size: 90%">
        <ul>
            <li class="replaceText" data-name="datepicker"         data-needle="DATE PICKER"><i class="fas fa-calendar-check" title="date picker"></i> Date Picker</li>
            <li class="replaceText" data-name="applicantName"      data-needle="APPLICANT NAME"><i class="fas fa-underline"></i> Applicant Name</li>
{{--            <li class="replaceText" data-name="applicantSignature" data-needle="APPLICANT SIGNATURE"><i class="fas fa-file-signature" title="signature"></i> Applicant Signature</li>--}}
            <li class="replaceText" data-name="corporateName"      data-needle="CORPORATE NAME"><i class="fas fa-underline"></i> Corporate Name</li>
            <li class="replaceText" data-name="corporateRep"       data-needle="CORPORATE REP"><i class="fas fa-underline"></i> Corporate Rep</li>
            <li class="replaceText" data-name="corporateTitle"     data-needle="CORPORATE TITLE"><i class="fas fa-underline"></i> Corporate Title</li>
            <li class="replaceText" data-name="corporateSignature" data-needle="CORPORATE SIGNATURE"><i class="fas fa-file-signature" title="signature"></i> Corporate Signature</li>
            <li class="replaceText" data-name="city"               data-needle="CITY"><i class="fas fa-city" title="signature"></i> City</li>
            <li class="replaceText" data-name="state"              data-needle="STATE"><i class="fas fa-flag" title="signature"></i> State</li>
            <li class="replaceText" data-name="email"              data-needle="EMAIL"><i class="fas fa-envelope"></i> Email Address</li>
            <li class="replaceText" data-name="phone"              data-needle="PHONE"><i class="fas fa-phone"></i> Phone Number</li>
        </ul>
    </div>
@endif
</body>
</html>
