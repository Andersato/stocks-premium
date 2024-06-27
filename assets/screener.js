/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './filters'
import {filters} from "./filters";

const $ = require('jquery');
require('bootstrap');

$(document).ready(function(){
    const url = new URL($(location).attr('href'));
    const searchParams = url.searchParams;

    for (const [key, value] of searchParams.entries()) {
        if (key !== 'page') {
            filters[key] = value;
            let selectId = 'screener_form_model_' + `${key}`
            $('#' + selectId).val(value)
        }
    }

    $('.select-filter').on('change', function() {
        filters[$(this).data('type')] = $(this).val()
        redirectUrl($(this).data('type'))
    })

    function redirectUrl(filterKey) {
        const url = new URL($(location).attr('href'));
        const searchParams = url.searchParams;

        if (searchParams.has('page')) {
            searchParams.delete('page');
        }

        for (const [key, value] of Object.entries(filters)) {
            if (value !== null && value !== '') {
                if (!searchParams.has(key)) {
                    searchParams.append(key, value);
                } else if(filterKey === key) {
                    searchParams.set(key, value);
                }
            } else {
                searchParams.delete(key);
            }
        }
        location.href = url.toString();
    }
});