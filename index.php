<?php

/*
=========================================
=========== QS APIs Worker ==============
=========================================
*/

class QS_APIs_worker
{
    public function __construct()
    {
        require(__DIR__ . '/includes/API_Config.php');
        new API_Config();

        require(__DIR__ . '/includes/Ajax_API.php');
        new Ajax_API();
    }
}

new QS_APIs_worker();