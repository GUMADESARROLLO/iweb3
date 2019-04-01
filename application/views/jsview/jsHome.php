<script>

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
    run_clock('clockdiv',deadline);
</script>