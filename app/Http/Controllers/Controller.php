<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $logFile;
    public $file;

    public function __construct()
    {
        $this->logFile = storage_path() . '\logs\admins.log';
    }

    /*
     *
     * ~~~~~~~~~~ Метод логирования операции с с темами ~~~~~~~~~~
     *
     * */

    public function logs($text)
    {
        $adm = \Auth::user();
        $admin = $adm->name . " ($adm->email)";
        $date = date("d-m-Y H:i:s");
        $text = "[$date] $admin $text";
        file_put_contents($this->logFile, $text . PHP_EOL, FILE_APPEND);
    }

    /*
     *
     * ~~~~~~~~~~ Метод отображения страницы информации ~~~~~~~~~~
     *
     * */

    public function infoReturn($infoText, $infoClass)
    {
        $info = array('infoText'=>$infoText, 'infoClass'=>$infoClass);
        return view('question.info', compact('info'));
    }
}
