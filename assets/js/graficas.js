$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
$(document).ready(function(){
    var grafica = new Grafica({});
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
                    $('#alert').html(data.message);
                }
            }
        });
    });
    $('#formFilter').submit(function(e){
        e.preventDefault();
        grafica.generateDatas($('#formFilter').serializeObject());
    });

});

class BaseCharts{
    constructor({el,title,series,tooltip,type}){
        this.el = el;
        this.title = title;
        this.series = series;
        this.tooltip = tooltip;
        this.type = type;
    }
    paint(title){
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
                    text: title
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


class Grafica{
    constructor({fecha_ini,fecha_fin,proyecto,turno}){
        var meses = this.ultimosMeses({fecha_ini,fecha_fin,proyecto,turno});
        var semanas = this.ultimasSemanas({fecha_ini,fecha_fin,proyecto,turno});
        var data = semanas.concat(meses).reverse();
        this.graficaMensual(data);
        this.graficaSemanal(data);
        this.createTable(data);
    }
    saveDatas(datas){
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
    graficaMensual(data){
    
        $.ajax({
            method: 'POST',
            url:'graficas/grafic1',
            data: {datas:JSON.stringify(data)},
            beforeSend: function(objeto){
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success:function(response){
                response = JSON.parse(response);
                if(response.success){
                    if(response.data){
                        var data = response.data;
                        data = data.map(function (data, index, array) {
                            return [data.name, parseFloat(data.produc_estimada/data.produc_real * 100)]; 
                        });
                        console.log(data);
                        const config = {
                            el:'container',
                            title: 'Productividad Mensual de 2021',
                            series: [{
                                name: 'Porcentaje',
                                data: data
                            }],
                            tooltip :'Porcentaje en 2021: <b>{point.y:.1f} %</b>',
                            type:'column'
                        };
                        var grafica = new BaseCharts(config);
                        grafica.paint();
                    }
                }
            }
        });
    }
    graficaSemanal(data){
        data = data[data.length-1];
        var date = data.date;
        $.ajax({
            method: 'POST',
            url:'graficas/grafic2',
            data: {datas:JSON.stringify(data)},
            beforeSend: function(objeto){
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success:function(response){
                response = JSON.parse(response);
                if(response.success){
                    if(response.data){
                        var data = response.data;
                        data = data.map(function (data, index, array) {
                            return [data.event, parseFloat(data.tiempo_caida_min)]; 
                        });
                        console.log(data);
                        const config = {
                            el:"container2",
                            title: 'Down Time Week '+moment(date).format('W'),
                            series: [{
                                name: 'Tiempo caido',
                                data: data
                            }],
                            tooltip :'Tiempo caido en 2021: <b>{point.y:.1f}</b>',
                            type:'column'
                        };
                        var grafica = new BaseCharts(config);
                        grafica.paint('Tiempo caido');
                    }
                }
            }
        });
        
    }
    createTBody(element,data){
        var tr = document.createElement("TR");
           
        var td = document.createElement("TD");
        var text = document.createTextNode(element);
        td.appendChild(text);
        
        tr.appendChild(td);
        document.getElementById("tbodyDinamico").appendChild(tr);
        var that = this;
        data.forEach(data => {
            var td = document.createElement("TD");
           
            data.element = element;
            var input = document.createElement('input');
            Object.entries(data).forEach(([key, value]) => {
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
                that.saveDatas(datas);
            });
            $.ajax({
                method: 'POST',
                url:'graficas/datas',
                data: data,
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
    ultimosMeses({fecha_ini,fecha_fin,proyecto,turno}){
        var number = 12;
        if(fecha_ini != null && fecha_fin != null){
            var fecha_iniAux = moment(fecha_ini);
            var fecha_finAux  = moment(fecha_fin);
            number = fecha_finAux.diff(fecha_iniAux, 'months') + 1 ;
        }else{
            fecha_fin = moment().format('YYYY-MM-DD');
        }
        var  meses = [];
        for(var i = 0;  i< number; i++){
            var mes = {};
            mes.number = moment(fecha_fin).subtract(i, 'months').format('MM');
            mes.name = moment(fecha_fin).subtract(i, 'months').format('MMMM');
            mes.year = moment(fecha_fin).subtract(i, 'months').format('YYYY');
            mes._type = 'month';
            mes.date = moment(fecha_fin).subtract(i, 'months').format('YYYY-MM-DD');
            meses.push(mes);
        }
        return meses;
    }
    ultimasSemanas({fecha_ini,fecha_fin,proyecto,turno}){
        var number = 4;
        if(fecha_fin == null){
            fecha_fin = moment().format('YYYY-MM-DD');
        }
        var  semanas = [];
        for(var i = 0;  i< number; i++){
            var semana = {};
            semana.number = moment(fecha_fin).subtract(i, 'weeks').format('W');
            semana.name = 'W'+moment(fecha_fin).subtract(i, 'weeks').format('W');
            semana.year = moment(fecha_fin).subtract(i, 'months').format('YYYY');
            semana._type = 'week';
            semana.date = moment(fecha_fin).subtract(i, 'months').format('YYYY-MM-DD');
            semanas.push(semana);
        }
        return semanas;
    }
    createTable(data){
        document.getElementById("trDinamico").innerHTML = '';
        var th = document.createElement("TH");
        var text = document.createTextNode("Elemento");
        th.appendChild(text);
        document.getElementById("trDinamico").appendChild(th);
        data.forEach(element => {
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
        document.getElementById("tbodyDinamico").innerHTML = '';
        elements.forEach(element => {
            this.createTBody(element,data);
        });
    }
    generateDatas(params){
        //{fecha_inicio: "2020-08-19", fecha_fin: "2021-07-19", proyecto: "3", turno: "2"}
        var meses = this.ultimosMeses(params);
        var semanas = this.ultimasSemanas(params);
        var data = semanas.concat(meses).reverse();
        this.graficaMensual(data);
        this.graficaSemanal(semanas.reverse());
        this.createTable(data);
    }
}