<?php

use App\Models\Branch;

if(!function_exists('tgl')) {

      function tgl() {
            return now()->toDateString();
      }
}

if(!function_exists('check_JK')) {

      
      function check_JK($jk, $umur) {
            if ($jk == 1 && $umur <= 16) return "童 - Anak Laki-Laki";
            else if ($jk == 1 && $umur > 16) return "乾 - Laki-Laki";
            else if ($jk == 2 && $umur <= 16) return "女 - Anak Perempuan";
            else return "坤 - Perempuan";
        }
}

