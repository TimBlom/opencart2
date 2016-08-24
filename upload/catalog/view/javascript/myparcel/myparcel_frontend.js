(function($){
    $(document).ready(function(){
        if (MYPARCEL_PAKJEGEMAK_URL) {
            $.ajaxPrefilter(function (options, _, jqXHR) {
                if (options.url == 'index.php?route=d_quickcheckout/field/getZone' || options.url == 'index.php?route=d_quickcheckout/payment_address/update') {
                    jqXHR.complete(function () {
                        var $pakjegemak_p = $("p.pakjegemak-wrapper");
                        if ($pakjegemak_p.length > 0) {
                            $pakjegemak_p.remove();
                        }
                        var $form = $("form#shipping_address_form");
                        var str = '<p class="pakjegemak-wrapper">Kies <span onclick="return pakjegemak();" style="cursor: pointer; text-decoration: underline">hier</span> uw locatie indien u het pakket op een PostNL afleverlocatie wil laten bezorgen.</p>';
                        if ($form.length > 0) {
                            var $first_form_field = $form.find('#shipping_address_firstname_input');
                            if ($first_form_field.length > 0) {
                                $first_form_field.before($(str));
                            }
                        }
                    });
                }
            });
        }
    });
})(jQuery);

var pg_popup;
function pakjegemak()
{
    if(!pg_popup || pg_popup.closed)
    {
        pg_popup = window.open(MYPARCEL_PAKJEGEMAK_URL, 'myparcelpakjegemak', "width=980,height=680,dependent,resizable,scrollbars");
        if(window.focus) { pg_popup.focus(); }
    }
    else
    {
        pg_popup.focus();
    }
    return false;
}