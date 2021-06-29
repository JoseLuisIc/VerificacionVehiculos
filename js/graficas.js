$(document).ready(function(){
    graficaMensual();
    graficaSemanal();
})
function graficaMensual(){
    const config = {
        el:'container',
        title: 'Cumplimiento Mensual de embarques 2021',
        series: [{
            name: 'Porcentaje',
            data: [
                ['Mar-20', 100],
                ['Abr-20', 100],
                ['May-20', 100],
                ['Jun-20', 100],
                ['Jul-20', 100],
                ['Ago-20', 100],
                ['Sep-20', 100],
                ['Oct-20', 100],
                ['Nov-20', 100],
                ['Dic-20', 100],
                ["ENE' 2021", 100],
                ["FEB' 2021", 100],
                ['W06', 100],
                ['W07', 100],
                ['W08', 100],
                ['W09', 100],
                ["MAR' 2021", 100],
                ['W10', 100],
                ['W11', 100],
                ['W12', 100],
                ['W13', 100]
            ]
        }],
        tooltip :'Porcentaje en 2021: <b>{point.y:.1f} %</b>',
        type:'column'
    }
    var grafica = new BaseCharts(config);
    grafica.paint();
}
function graficaSemanal(){
    const config = {
        el:"container2",
        title: 'Embarques Semanal 2021',
        series: [{
            name: 'Porcentaje',
            data: [
                ['1410', 100],
                ['1411', 100],
                ['1412', 100],
                ['1413', 100],
                ['500B-DS', 100],
                ['500B-PS', 100],
                ['1496', 0],
                ['1497', 0],
                ['1498', 0],
                ['1499', 0]
            ]
        }],
        tooltip :'Porcentaje en 2021: <b>{point.y:.1f} %</b>',
        type:'column'
    }
    var grafica = new BaseCharts(config);
    grafica.paint();
}
class BaseCharts{
    constructor({el,title,series,tooltip,type}){
        this.el = el;
        this.title = title;
        this.series = series;
        this.tooltip = tooltip;
        this.type = type;
    }
    paint(){
        Highcharts.chart(this.el, {
            chart: {
                type: this.type//'column'
            },
            plotOptions: {
                series: {
                  stacking: 'percent',
                }
            },
            title: {
                text: this.title
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Porcentaje (%)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: this.tooltip
            },
            series: this.series
        });
    }
}