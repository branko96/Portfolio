$(document).ready(function(){
    
    var randomScalingFactor = function(){ return Math.round(Math.random()*5000)};

    var barChartData = {
        labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio"],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,0.8)",
                highlightFill : "rgba(151,187,205,0.75)",
                highlightStroke : "rgba(151,187,205,1)",
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            }
        ]

    }
    window.onload = function(){
        var ctx = document.getElementById("comprasMensuales").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive : true
        });
    }

})

// PIECHART
$(document).ready(function(){

    var pieChart = document.getElementById("sexoSocios").getContext("2d");
    
    var data={
          'action': 'sexoSocio'
         }

    $.ajax({
           type: "POST",
              url:"content/controllers/socio.ctrl.php",
              data:data,
              success: function(res){
               var sexo = $.parseJSON(res);                
                          
                   var pieData = [
                        {
                            value: sexo['M'],
                            color:"#ACC9D7",
                            highlight: "#CBDDE6",
                            label: "Hombres"
                        },
                        {
                            value: sexo['F'],
                            color: "#eed0f0",
                            highlight: "#f0e0f1",
                            label: "Mujeres"
                        }
                   
                    ]


                window.myPie = new Chart(pieChart).Pie(pieData);
            } 
                             
              
        });

    

})