<!-- DOCTYPE html -->
<!-- html -->
  <!-- head -->
  <!-- head included in common files -->
    <?php
      /* include common files */
      require_once( $_SERVER['DOCUMENT_ROOT'] . '/inc/nssl-common.php' ); // define site root variable, among other things
      require_once( $nssl_site_root . '/inc/nssl-menulib.php' );
      require_once( $nssl_site_root . '/travel/form/travel-common.php' );

      /* configuration variables */
      unset( $page_meta_options );
      /* set meta options */
      $page_meta_options = array(
      	'page_id' => 'its_patchA',
      	'section_id' => 'its',
      	'url' => 'https://intranet.nssl.noaa.gov/its/patcha/', // canonical
      	'title' => 'Server Patch & Update Alerts',
      	'description' => 'A site to manage alerts for server patches and updates.
                          Since maintenance routines can potentially disrupt on-going
                          processes, the site allows users to request scheduling
                          changes for specific servers.',
      	'subject' => 'ITS Maintenance Management',
      	'keywords' => 'patches, updates, IT, maintenance',
      	'creation_date' => '2017-09-01', // yyyy-mm-dd
      );
    ?>

    <?php require_once($nssl_site_root . '/inc/nssl-start.php'); // open the page ?>
    <?php include_once($nssl_site_root . '/inc/nssl-meta.php'); // social and meta tags ?>
    <?php include_once($nssl_site_root . '/inc/nssl-favicons.html'); // favicons and touch icons ?>
    <link rel='stylesheet' type='text/css' href='/css/style.css'/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title><?php echo $page_meta_options['title']; ?></title>
  </head>
  <body>
  	<div class="page-wrapper">
  		<?php include_once($nssl_site_root . '/inc/nssl-screenreader.html'); // screenreader links ?>
  		<?php echo generateMainMenu( 'drawer' ); ?>
  		<header>
  			<!--?php require_once($nssl_site_root . '/inc/nssl-status.php');?-->
  			<?php include_once($nssl_site_root . '/inc/nssl-topnav.html'); // search & social links ?>
  			<?php require_once($nssl_site_root . '/inc/nssl-mainbanner.php'); ?>
  			<?php echo generateMainMenu( 'dropdown' ); ?> </header>
  		<div id="content" class="cf2">
  			<ul id="breadcrumbs">
  				<li class="breadcrumb-item"><a href="/">NSSL Intranet</a></li>
  				<li class="breadcrumb-item"><a href="/its/">ITS</a></li>
  				<li class="breadcrumb-item current" title="You are here."><?php echo $page_meta_options['title']; ?></li>
  			</ul>
  			<div id="main" class="cf2">
  				<div class="main-wrapper cf2">
  					<h2 class="page_title">
  						<?php echo $page_meta_options['title']; ?>
  					</h2>


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
          </div>
          <!-- .main-wrapper -->
        </div>
        <!-- #main -->
        <aside id="sidebar" class="cf modular">
          <div class="sidebar-wrapper">
            <?php echo generateSidebarMenu(); ?>
          </div>
          <!-- .sidebar-wrapper -->
       </aside>
       <!-- #sidebar -->
      </div>
      <!-- #content -->
      <?php include_once($nssl_site_root . '/inc/nssl-footer.php'); ?>
    </div>
    <!-- .page-wrapper -->
    <?php require_once($nssl_site_root . '/inc/nssl-footerscripts.php'); // jquery, etc. ?>
    <?php require_once($nssl_site_root . '/inc/fancybox.html'); // jquery, etc. ?>
    <?php require_once($nssl_site_root . '/inc/form-validator.html'); // jquery, etc. ?>
  </body>
</html>
