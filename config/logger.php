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
     * For example setting level to notice will mute the debug and info logs.
     *
     * Note: Unhandled exceptions belongs to the error level.
     */
    'level' => 'warning'

];
