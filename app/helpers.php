<?php

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\DataPelita;


if(!function_exists('tgl')) {

      function tgl() {
            return now()->toDateString();
      }
}

if(!function_exists('check_JK')) {


      function check_JK($jk, $umur) {
            if ($jk == 1 && $umur <= 16) return "童";
            else if ($jk == 1 && $umur > 16) return "乾";
            else if ($jk == 2 && $umur <= 16) return "女";
            else return "坤";
            // if ($jk == 1 && $umur <= 16) return "童 - Anak Laki-Laki";
            // else if ($jk == 1 && $umur > 16) return "乾 - Laki-Laki";
            // else if ($jk == 2 && $umur <= 16) return "女 - Anak Perempuan";
            // else return "坤 - Perempuan";
        }
}

if(!function_exists('getYear')) {


      function getYear() {

            $now = Carbon::now();
                  return  $now->year;
        }
}
// if(!function_exists('getNamaBranch')) {
      // function getNamaBranch($kode_branch) {
      //       // $branch =  Branch::find(Auth::user()->branch_id);
      //       $branch =  Branch::find($kode_branch);
      //       // return 'Kode Branch = '.$kode_branch;
      //       return 'hello';
      //       // return $branch->nama_branch;
      // }
      function getNamaBranch() {

            return 'hello';
            // return $branch->nama_branch;
      }

      function getName($id) {
        $data = DataPelita::find($id);
        return $data->nama_umat;
      }
// }

