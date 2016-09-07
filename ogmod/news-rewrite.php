<?php
http://www.jobfair.ba/ = true;

    if(http://www.jobfair.ba/) {
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(-1);
    }

$SITE_ROOT = root_url;



function makePage($data, $siteRoot) {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta property="og:title" content="<?php echo $data[0]->naslov; ?>" />
            <meta property="og:description" content="<?php echo $data[0]->opis; ?>" />
            <meta property="og:image" content="<?php echo $data[0]->velika_slika; ?>" />
            <!-- etc. -->
        </head>
        <body>
            <p><?php echo $data[0]->opis; ?></p>
            <img src="<?php echo $data[0]->velika_slika; ?>">
        </body>
    </html>
    <?php
}
?>