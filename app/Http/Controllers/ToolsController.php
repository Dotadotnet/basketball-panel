<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;

class ToolsController extends Controller
{
    public function convertJalaliToGregorian($date, $need_hour = true)
    {
        if ($date != null) {
            $y = substr($date, 0, 4);
            $m = substr($date, 5, 2);
            $d = substr($date, 8, 2);
            $h = substr($date, 11, 2);
            $i = substr($date, 14, 2);
            $s = substr($date, 17, 2);

            $verta = new Verta();
            $gre = $verta->getGregorian($y, $m, $d);
            if (! $need_hour) {
                $gre[1] = strlen($gre[1] == 1) ? '0'.$gre[1] : $gre[1];
                $gre[2] = strlen($gre[2] == 1) ? '0'.$gre[2] : $gre[2];

                return "{$gre[0]}/{$gre[1]}/{$gre[2]}";
            }
            $date = "{$gre[0]}/{$gre[1]}/{$gre[2]} {$h}:{$i}:{$s}";

            return $date;
        }

        return null;
    }

    public function convertGregorianToJalali($date, $need_hour = true)
    {
        if ($date != null) {
            $y = substr($date, 0, 4);
            $m = (strlen(substr($date, 5, 2)) == 2) ? substr($date, 5, 2) : '0'.substr($date, 5, 2);
            $d = substr($date, 8, 2);
            $h = substr($date, 11, 2);
            $i = substr($date, 14, 2);
            $s = substr($date, 17, 2);

            $verta = new Verta();
            $ja = $verta->getJalali($y, $m, $d);
            if (! $need_hour) {
                $ja[1] = strlen($ja[1] == 1) ? '0'.$ja[1] : $ja[1];
                $ja[2] = strlen($ja[2] == 1) ? '0'.$ja[2] : $ja[2];

                return "{$ja[0]}/{$ja[1]}/{$ja[2]}";
            }
            $date = "{$ja[0]}/{$ja[1]}/{$ja[2]} {$h}:{$i}:{$s}";

            return $date;
        }

        return null;
    }

    public function reverseGregorianToJalali($date)
    {
        if ($date != null) {
            $y = substr($date, 0, 4);
            $m = (strlen(substr($date, 5, 2)) == 2) ? substr($date, 5, 2) : '0'.substr($date, 5, 2);
            $d = substr($date, 8, 2);
            $h = substr($date, 11, 2);
            $i = substr($date, 14, 2);
            $s = substr($date, 17, 2);

            $verta = new Verta();
            $ja = $verta->getJalali($y, $m, $d);
            $ja[1] = (strlen($ja[1]) == 2) ? $ja[1] : '0'.$ja[1];
            $date = "{$ja[0]}/{$ja[1]}/{$ja[2]} {$h}:{$i}:{$s}";

            return $date;
        }

        return null;
    }
}
