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

import CanvasJS from '@canvasjs/charts';
import CanvasStockJS from '@canvasjs/stockcharts';

$(document).ready(function(){

    let ticker = $('.ticker').data('ticker');

    callMetricsPercentage('chartInstOwn', 'Compras de institucionales', 'Porcentaje de compras',  "#F08080", ticker, 'instOwn')
    callMetricsPrice('chartPrice', 'Precio de la acción', 'Precio',  "#F08044", ticker, 'price')
    callMetricsVolume('chartVolume', 'Volumen diario de la acción', 'Volumen',  "#36D6B4", ticker, 'volume')
    callMetricsPriceAndVolume('chartPriceVolume', 'Precio y Volumen diario de la acción', 'Price',  "#36D6B4", ticker, ['price', 'volume'])
    callMetricsPercentage('chartShortFloat', 'Porcentajes de cortos', 'Porcentaje de cortos',  "#F02000", ticker, 'shortFloat')

    function callMetricsPercentage (containerName, title, titleY, color, ticker, metricName) {
        let uri = getMetricUri(ticker, [metricName])

        let dataPoints = [];

        $.get(uri, function( data ) {
            $.each(data, function(key, metric){
                dataPoints.push({x: new Date(metric['createdAt']), y: metric[metricName]});
            })

            let options = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: title + ' ' + ticker
                },
                axisX:{
                    valueFormatString: "DD MMM"
                },
                axisY: {
                    title: titleY,
                    suffix: "%",
                    minimum: 0,
                    maximum: 100
                },
                toolTip:{
                    shared:true
                },
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type: "line",
                    showInLegend: true,
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY",
                    color: color,
                    dataPoints: dataPoints
                }]
            };

            let chart = new CanvasJS.Chart(containerName, options);
            chart.render();
        });
    }

    function callMetricsPrice (containerName, title, titleY, color, ticker, metricName) {
        let uri = getMetricUri(ticker, [metricName])

        let dataPoints = [];

        $.get(uri, function( data ) {
            $.each(data, function(key, metric){
                dataPoints.push({x: new Date(metric['createdAt']), y: metric[metricName]});
            })

            let options = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: title + ' ' + ticker
                },
                axisX:{
                    valueFormatString: "DD MMM"
                },
                axisY: {
                    title: titleY,
                    suffix: "$",
                    minimum: 0
                },
                toolTip:{
                    shared:true
                },
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type: "line",
                    showInLegend: true,
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY",
                    color: color,
                    dataPoints: dataPoints
                }]
            };

            let chart = new CanvasJS.Chart(containerName, options);
            chart.render();
        });
    }

    function callMetricsPriceAndVolume (containerName, title, titleY, color, ticker) {
        let uri = getMetricUri(ticker, ['price', 'volume'])

        let dataPointsPrice = [];
        let dataPointsVolume = [];

        $.get(uri, function( data ) {
            $.each(data, function(key, metric){
                dataPointsPrice.push({x: new Date(metric['createdAt']), y: metric['price']});
                dataPointsVolume.push({x: new Date(metric['createdAt']), y: metric['volume']});
            })

            let options = {
                title: {
                    text: title + ' ' + ticker
                },
                charts: [{
                    axisY: {
                        prefix: "$",
                        title: "Precio"
                    },
                    data: [{
                        type: "line",
                        color: 'F08080',
                        dataPoints : dataPointsPrice
                    }]
                },{
                    height: "50%",
                    axisY: {
                        title: "Volumen"
                    },
                    data: [{
                        color: color,
                        dataPoints : dataPointsVolume
                    }]
                }]
            };

            let stockChart = new CanvasStockJS.StockChart(containerName, options);
            stockChart.render();
        });
    }

    function callMetricsVolume (containerName, title, titleY, color, ticker) {
        let uri = getMetricUri(ticker, ['volume'])

        let dataPoints = [];

        $.get(uri, function( data ) {
            $.each(data, function(key, metric){
                dataPoints.push({x: new Date(metric['createdAt']), y: metric['volume']});
            })

            let options = {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: title + ' ' + ticker
                },
                axisX:{
                    valueFormatString: "DD MMM"
                },
                axisY: {
                    title: titleY
                },
                toolTip:{
                    shared:true
                },
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type: "column",
                    showInLegend: true,
                    xValueFormatString: "DD MMM, YYYY",
                    color: color,
                    dataPoints: dataPoints
                }]
            };

            let chart = new CanvasJS.Chart(containerName, options);
            chart.render();
        });
    }

    function getMetricUri(ticket, metrics) {
        let uri = `/api/stock-data-graphics/${ticker}/metrics?`
        for (let i = 0; i < metrics.length; i++) {
            uri += 'metrics[]=' + metrics[i]
            if ((i+1) < metrics.length) {
                uri += '&'
            }
        }

        return uri
    }

    function toogleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else{
            e.dataSeries.visible = true;
        }
        e.chart.render();
    }
});