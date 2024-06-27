/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('#inputAutocomplete').keyup(function () {
        let query = $(this).val();
        if (query !== '') {
            $.ajax({
                url: '/api/tickers-autocomplete?value=' + `${query}`,
                method: 'GET',
                success: function (data) {
                    let listaHtml = '';
                    data.forEach(function (value) {
                        listaHtml += '<li class="list-group-item d-flex" data-text="' + value.name + '" data-ticker="' + value.ticker + '"><span class="flex-fill">' + value.ticker + '</span><span class="flex-fill justify-content-start">' + value.name + '</span></li>';
                    });
                    $('#listaResultados').html(listaHtml);
                }
            });
        }
    });

});

$(document).on('click', '#listaResultados li', function(){
    let text = $(this).data('text');
    let ticker = $(this).data('ticker');
    console.log(text)
    $('#inputAutocomplete').val(text);
    $('#listaResultados').html('');
    location.href = '/show/' + `${ticker}`;
});