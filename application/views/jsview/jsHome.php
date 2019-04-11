<script>
    var flattened = [];
    function flatten(json, acc, inArray) {
        var key;

        acc = acc || [];
        for(key in json) {
            if(inArray) {
                key = +key;  //coerce to number
            }
            if(json[key] instanceof Array) {
                flattened.push(acc.concat([key, 'arr']));
                flatten(json[key], acc.concat([key, 'arr']), true);
            }
            else if(json[key] instanceof Object) {
                flattened.push(acc.concat([key, 'obj']));
                flatten(json[key], acc.concat([key, 'obj']));
            }
            else {
                flattened.push(acc.concat(key, json[key]));
            }
        }
    }
    var Char = {
        chart: {
            type: 'column',
            renderTo: 'container',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 20
            }
        },
        title: {
            text: 'VENTAS POR VENDEDOR (MES ACTUAL)'
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: ''
            }
        }, 
        plotOptions: {
            series: {
                 cursor: 'pointer',
                 point: {
                     events: {
                        click: function() {
                            //alert ('Category: '+ this.category +', value: '+ this.y);
                            $("#titulo_ruta").html(this.category);
                            $("#modal_detalle_ruta").openModal();
                            $.ajax({
                                url: "StatVendedor/"+this.category ,
                                type: 'get',
                                async: true,
                                success: function(data) {
                                    if (data.length!=0) {
                                        $.each(JSON.parse(data), function(i, item) {

                                            var p1= item['ruta'][1];
                                            var p4= item['ruta'][0];

                                            var Meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

                                            $("#M4").html(Meses[(p4 - 4)]);
                                            $("#M3").html(Meses[(p4 - 3)]);
                                            $("#M2").html(Meses[(p4 - 2)]);
                                            $("#M1").html(Meses[(p4 - 1)]);


                                            $('#Tbl_3mVendedor').DataTable({
                                                responsive:true,
                                                "autoWidth":false,
                                                "destroy": true,
                                                "data": item['array_1'],
                                                "info":    false,
                                                "bPaginate": true,
                                                "paging": true,
                                                "ordering": false,
                                                "pagingType": "full_numbers",
                                                "emptyTable": "No hay datos disponibles en la tabla",
                                                "language": {
                                                    "zeroRecords": "No hay datos disponibles"
                                                },
                                                columns: [
                                                    { "data": "CLS" },
                                                    { "data": "NOMBRE" },
                                                    { "data": p1, render: $.fn.dataTable.render.number( ',', '.', 2 )},
                                                    { "data": (p4 - 2 ), render: $.fn.dataTable.render.number( ',', '.', 2 ) },
                                                    { "data": (p4 - 1 ), render: $.fn.dataTable.render.number( ',', '.', 2 ) },
                                                    { "data": p4, render: $.fn.dataTable.render.number( ',', '.', 2 ) }
                                                ],
                                                initComplete: function () {

                                                    $("#Tbl_3mVendedor_length").hide();
                                                }
                                            });

                                            $('#Tbl_Articulos_Facturados').DataTable({
                                                responsive:true,
                                                "autoWidth":false,
                                                "destroy": true,
                                                "data": item['array_2'],
                                                "info":    false,
                                                "bPaginate": true,
                                                "paging": true,
                                                "ordering": false,
                                                "pagingType": "full_numbers",
                                                "emptyTable": "No hay datos disponibles en la tabla",
                                                "language": {
                                                    "zeroRecords": "No hay datos disponibles"
                                                },
                                                columns: [
                                                    { "data": "ARTICULO" },
                                                    { "data": "DESCRIPCION" },
                                                    { "data": "Venta", render: $.fn.dataTable.render.number( ',', '.', 2 )},
                                                ],
                                                initComplete: function () {
                                                    var tt  = 0;
                                                    this.api().columns([2]).every( function () {
                                                        this.data().each( function ( d, j ) {
                                                            tt += parseFloat(numeral(d).format('00.00'));
                                                        } );

                                                        $("#span_tt_Facturado").html("C$ " + numeral(tt).format("0,0.00"));
                                                    } );
                                                    $("#Tbl_Articulos_Facturados_length").hide();


                                                }
                                            });
                                             $('#Tbl_Articulos_no_Facturados').DataTable({
                                                responsive:true,
                                                "autoWidth":false,
                                                "destroy": true,
                                                "data": item['array_3'],
                                                "info":    false,
                                                "bPaginate": true,
                                                "paging": true,
                                                "ordering": false,
                                                "pagingType": "full_numbers",
                                                "emptyTable": "No hay datos disponibles en la tabla",
                                                "language": {
                                                    "zeroRecords": "No hay datos disponibles"
                                                },
                                                columns: [
                                                    { "data": "ARTICULO" },
                                                    { "data": "DESCRIPCION" }
                                                ],
                                                initComplete: function () {
                                                    $("#Tbl_Articulos_no_Facturados_length").hide();
                                                }
                                            });


                                        });
                                        }else if (data.length===0) {
                                        alert("Error");
                                    }

                                }
                            });
                        }
                    }
                }
            }
        },       
        series: [{
            colorByPoint: true,
            data: [],
            name: 'Monto',
            showInLegend: false
        }]
    };

    $.getJSON("StatHome", function(d) {

        $("#id_Ventas_span").html(d.Info[0].mVentas);
        $("#id_Cobro_span").html(d.Info[0].mCobro);
        $("#id_Puntos_span").html(d.Info[0].mPuntos);


        Char.xAxis.categories = d.name;
        Char.series[0].data = d.data;

        new Highcharts.Chart(Char);
    });




    var time_in_minutes = 1;
    var current_time = Date.parse(new Date());
    var deadline = new Date(current_time + time_in_minutes*60*1000);


    function time_remaining(endtime){
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor( (t/1000) % 60 );
        var minutes = Math.floor( (t/1000/60) % 60 );
        var hours = Math.floor( (t/(1000*60*60)) % 24 );
        var days = Math.floor( t/(1000*60*60*24) );
        return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
    }
    function run_clock(id,endtime){
        var clock = document.getElementById(id);
        function update_clock(){
            var t = time_remaining(endtime);
            clock.innerHTML = 'Actualizando en '+t.seconds+' seg...';
            if(t.total<=0){
                clearInterval(timeinterval);
                window.location='Home';
            }
        }
        update_clock(); // run function once at first to avoid delay
        var timeinterval = setInterval(update_clock,1000);
    }
    //run_clock('clockdiv',deadline);
</script>