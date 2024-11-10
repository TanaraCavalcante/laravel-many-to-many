<?php
namespace App\Functions;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Helpers
{
    //TODO -- Metodo per gestire un file csv
    public static function getCsv(string $filePath)
    {
        $result = [];

        //Abro o file apenas em leitura
        $file = fopen($filePath, 'r');

        if($file === false){
            throw new FileNotFoundException('File not avaliable at this path');
        }
        while (($row = fgetcsv($file)) !== false){
            $result[] = $row;
        }
        fclose($file);
        return $result;
    }
}