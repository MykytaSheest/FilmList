<?php

namespace Services;

class FileService
{
    public function parseFile($data)
    {
        $array = null;
        if ($data) {
            while (($buffer = fgets($data)) !== false) {
                $array[] = $buffer;
            }
        }
        fclose($data);

        $j = 0;
        $result = [];
        $formats = [
            "VHS" => 1,
            "DVD" => 2,
            "Blu-Ray" => 3
        ];
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] != "\n") {
                $current = explode(':', trim($array[$i]));
                if (trim($current[0]) == 'Stars') {
                    $result[$j]['actors'] = explode(',', $current[1]);
                    $j++;
                    continue;
                } elseif (trim($current[0]) == 'Format') {
                    $result[$j]['format'] = $formats[trim($current[1])];
                } elseif (trim($current[0]) == 'Release Year') {
                    $result[$j]['year'] = $current[1];
                } elseif (trim($current[0]) == 'Title') {
                    $result[$j]['title'] = $current[1];
                }
            }
        }
        return $result;
    }
}
