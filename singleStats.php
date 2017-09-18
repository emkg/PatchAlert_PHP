<?php require('top.php'); ?>



            <div class='page-container'>
                Summary of Exceptions Requested
                <div id='piechart' class='chart'></div>
                <div id='barchart' class='chart'></div>
                <div id='calchart' class='chart'></div>
            </div>


            <?php
                  // individual stats
            ?>
            <script type="text/javascript">
                // Load the Visualization API and the corechart package.
                google.charts.load('current', {'packages':['corechart']});
                google.charts.load("current", {packages:['timeline']});
                // Set a callback to run when the Google Visualization API is loaded.
                google.charts.setOnLoadCallback(drawChart);
                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                function drawChart() {
                  // Create the data table.
                  var data = new google.visualization.DataTable();
                  data.addColumn('string', 'Server');
                  data.addColumn('number', 'Count');
                  data.addRows([
                    {% for k,v in servers.items() %}
                      ['{{k}}', {{v}}],
                    {%endfor%}
                  ]);

                  var data2 = google.visualization.arrayToDataTable([
                    ['Server', 'Count'],
                    {% for k,v in servers.items() %}
                      ['{{k}}', {{v}}],
                    {%endfor%}
                  ]);

                  var calData = new google.visualization.DataTable();
                  calData.addColumn({ type: 'string', id: 'User' });
                  calData.addColumn({ type: 'date', id: 'Service Scheduled Date' });
                  calData.addColumn({ type: 'date', id: 'Alt Suggested Date' });
                  calData.addRows([
                    {% for r in requests %}
                      [ '{{r.user}}', new Date('{{alertDate}}'),new Date('{{r.altDate}}')],
                    {% endfor %}

                  ]);

                  // Set chart options
                  var options1 = {
                    'title':'Requested Servers',
                    'width':400,
                    'height':400,
                    'legend': { position: 'none' }
                  };

                  var options2 = {
                    'title' : 'Requested Alternative Update Times',
                    'width':400,
                    'height':400,
                    'legend': { position: 'none' }
                  };


                  // Instantiate and draw our chart, passing in some options.
                  var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
                  piechart.draw(data, options1);
                  var barchart = new google.visualization.BarChart(document.getElementById('barchart'));
                  barchart.draw(data2, options1);
                  var calchart = new google.visualization.Timeline(document.getElementById('calchart'));
                  calchart.draw(calData, options2);
                }
            </script>
  <?php require('bottom.php'); ?>
