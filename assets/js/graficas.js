$(document).ready(function(){
    graficaMensual();
    graficaSemanal();
    $('#formIncidencia').submit(function(e){
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url:'graficas/create',
            data: $('#formIncidencia').serialize(),
            beforeSend: function(objeto){
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success:function(data){
                data = JSON.parse(data);
                if(data.success){
                    $('.bs-example-modal-lg-new').modal('hide');
                    $('#alert').html(data.message)
                }
            }
        });
    });
});
function ultimosMeses(number,ano){
    var  meses = [];
    for(var i = 0;  i< number; i++){
        var mes = {};
        mes.number = moment().subtract(i, 'months').format('MM');
        mes.name = moment().subtract(i, 'months').format('MMMM');
        mes.year = moment().subtract(i, 'months').format('YYYY');
        mes._type = 'month';
        meses.push(mes);
    }
    return meses;
}
function ultimasSemanas(number/*cuantas semanas requiero*/,mes){
    var  semanas = [];
    for(var i = 0;  i< number; i++){
        var semana = {};
        semana.number = moment().subtract(i, 'weeks').format('W');
        semana.name = 'W'+moment().subtract(i, 'weeks').format('W');
        semana.year = moment().subtract(i, 'months').format('YYYY');
        semana._type = 'week';
        semanas.push(semana);
    }
    return semanas;
}
function getDatas(){
    var meses = ultimosMeses(12,0);
    var semanas = ultimasSemanas(4,0);
    
    createTable(meses,semanas);
}
function createTable(meses,semanas){
    var table = semanas.concat(meses).reverse();
    var th = document.createElement("TH");
        var text = document.createTextNode("Elemento");
        th.appendChild(text);
        document.getElementById("trDinamico").appendChild(th);
    table.forEach(element => {
        var th = document.createElement("TH");
        var text = document.createTextNode(element.name.slice(0, 3));
        element.color = 'green';
        th.appendChild(text);
        document.getElementById("trDinamico").appendChild(th);
    });
    var elements = [
        'Mano de obra',																
        'Medicion'		,														
        'Medio ambiente',																
        'Maquinaria',																
        'Metodo'	,															
        'Material'
    ];
    elements.forEach(element => {
        createTBody(element);
    });
}
function createTBody(element){
    var meses = ultimosMeses(12,0);
    var semanas = ultimasSemanas(4,0);

    var table = semanas.concat(meses).reverse();
    var tr = document.createElement("TR");
       
    var td = document.createElement("TD");
        var text = document.createTextNode(element);
        td.appendChild(text);
        
        tr.appendChild(td);
        document.getElementById("tbodyDinamico").appendChild(tr);
    
    table.forEach(datas => {
        var td = document.createElement("TD");
       
        datas.element = element;
        var input = document.createElement('input');
        Object.entries(datas).forEach(([key, value]) => {
            input.setAttribute(key, value);
        });
        input.type = 'color';
        input.style.width ='24px';
        input.style.height = '24px';
        input.style.cursor = ' pointer';
        input.style.border = 'none !important';
        input.classList.add('color');
        td.appendChild(input);
        input.addEventListener('change',function(e){
            var datas = {
                element: element,
                name: this.getAttribute('name'),
                number: this.getAttribute('number'),
                year: this.getAttribute('year'),
                type: this.getAttribute('_type'),
                color: this.value,
                id: this.getAttribute('id') != null ? this.getAttribute('id') : 0
            };
            saveDatas(datas);
        });
        $.ajax({
            method: 'POST',
            url:'graficas/datas',
            data: datas,
            beforeSend: function(objeto){
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success:function(response){
                response = JSON.parse(response);
                if(response.success){
                    var color = '#0be2b9';
                    if(response.data){
                        color = response.data['color'];
                        input.setAttribute('id',response.data['id']);
                    }
                    input.value = color;
                }
            }
        });

        tr.appendChild(td);
        document.getElementById("tbodyDinamico").appendChild(tr);
    });
}
function saveDatas(datas){
    $.ajax({
        method: 'POST',
        url:'graficas/saveGrafic',
        data: datas,
        beforeSend: function(objeto){
            $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            //data = JSON.parse(data);
            //if(data.success){
               
            //}
        }
    });
}
getDatas();

function graficaMensual(){
    var meses = ultimosMeses(12,0);
    var semanas = ultimasSemanas(4,0);

    var data = semanas.concat(meses).reverse();
    var mapData = data.map(function(obj){
        var newObject = [obj.name, 100];
        return newObject;
     });
    const config = {
        el:'container',
        title: 'Productividad Mensual de 2021',
        series: [{
            name: 'Porcentaje',
            data: mapData
        }],
        tooltip :'Porcentaje en 2021: <b>{point.y:.1f} %</b>',
        type:'column'
    };
    var grafica = new BaseCharts(config);
    grafica.paint();
}
function graficaSemanal(){
    const config = {
        el:"container2",
        title: 'Productividad Semanal 2021',
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
    };
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