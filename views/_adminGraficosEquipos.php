
<style type="text/css">
${demo.css}
        </style>


<script src="assets/assetsAdmin/js/modules/exporting.js"></script>

<script type="text/javascript">


$(function () {
	        $('#container1').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Top 10 Equipos con más partidos'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
                
                foreach($vars['partidos'] as $res){
?>

                ['<?php echo $res['nombre'] ?>'],
<?php
}
?>

            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Equipos ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Partidos',
            data: [
<?php
            foreach($vars['partidos'] as $res){
?>

                [<?php echo $res['partidos'] ?>],
<?php
}
?>


            ]
        }]
    });
});

$(function () {

	$('#container2').highcharts({
 chart: {
            type: 'bar'
        },
        title: {
            text: 'Equipos y su edad promedio'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
                
             
              foreach($vars['edad'] as $row){
                   
                
?>

                [<?php echo $row['edadPromedio'] ?>],
<?php
    }
?>

            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Equipos ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Equipos'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Numero Equipos',
            data: [
<?php
                
                
                 foreach($vars['edad'] as $row){
?>

                [<?php echo $row['cantidad'] ?>],
<?php
    }
?>


            ]
        }]
    });
});

/*
$(function () {
});*/
/*
$(function () {
});*/
/*
$(function () {
});*/
    </script>

    <div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
