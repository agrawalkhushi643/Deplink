<?php

return [

    /**
     * Path to the file with server logs
     * (relative to the root directory).
     */
    'file' => 'storage/logs',

    /*
     * Log levels from the least to the most important ones:
     * debug, info, notice, warning, error, alert, critical emergency
     *
     * Log level determine which of the logs will be written to the log file.
     * All logs below the specified log level will be omitted in the log file.
     *
     * Example: Setting level to warning will mute the debug, info and notice logs.
     */
    'level' => 'warning'

];
