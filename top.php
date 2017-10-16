<!-- DOCTYPE html -->
<html>
  <head>
    <?php


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
    <link rel='stylesheet' type='text/css' href='css/style.css'/>
    <link rel='stylesheet' type='text/css' href='../css/style.css'/>
    <title><?php echo $page_meta_options['title']; ?></title>
  </head>
  <body>
