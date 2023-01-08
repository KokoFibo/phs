<?php

use Carbon\Carbon;
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

if(!function_exists('getYear')) {

      
      function getYear() {

            $now = Carbon::now();
                  return  $now->year;
        }
}
if(!function_exists('getNamaBranch')) {
      function getNamaBranch($kode_branch) {
            // $branch =  Branch::find(Auth::user()->branch_id);
            $branch =  Branch::find($kode_branch);
            return $branch->nama_branch;
      }
}

