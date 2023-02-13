<?php

use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\Branch;
use App\Models\DataPelita;
use App\Models\Daftarkelas;


if(!function_exists('tgl')) {

      function tgl() {
            return now()->toDateString();
      }
}

if(!function_exists('check_JK')) {


      function check_JK($jk, $umur) {
            if ($jk == 'Laki-laki' && $umur <= 16) return "童";
            else if ($jk == 'Laki-laki' && $umur > 16) return "乾";
            else if ($jk == 'Perempuan' && $umur <= 16) return "女";
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

      function getBranch($id) {
        $data = Branch::find($id);
        return $data->nama_branch;
      }

      function getKelas($id) {
        $data = Kelas::find($id);
        return $data->nama_kelas;
      }

      function getDaftarKelas($id) {
        $kelas_id = Daftarkelas::find($id);

        $nama_kelas = Kelas::find($kelas_id->kelas_id);
        return $nama_kelas->nama_kelas;

      }

      function getDaftarKelasCetya($id) {
        $branch_id = Daftarkelas::find($id);

        $nama_branch = Branch::find($branch_id->branch_id);
        return $nama_branch->nama_branch;

      }

      function smartCapitalize($name) {
        $str = strtolower($name);
        $str = ucwords($str);
        return $str;
      }



      function roleCheck($role) {
        switch($role) {
            case '0': $rolename='User'; break;
            case '1': $rolename='Admin'; break;
            case '2': $rolename='Supervisor'; break;
            case '3': $rolename='Manager'; break;
        }

        return $rolename;
      }


// }

