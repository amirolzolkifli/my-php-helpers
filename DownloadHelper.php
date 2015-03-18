<?php
class DownloadHelper {

    // Function to force download for external file URI using cURL
    public static function download_external_file( $file_uri )
    {
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_uri );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $r = curl_exec($ch);
        curl_close($ch);
        header('Expires: 0'); // Set no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
        header('Cache-Control: private', false);
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="' . basename( $file_uri ) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($r)); // Provides file size
        header('Connection: close');
        echo $r;
    }
    
}