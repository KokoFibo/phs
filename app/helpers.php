<?php

use Carbon\Carbon;
use App\Models\Kota;
use App\Models\Kelas;
use App\Models\Branch;
use App\Models\Absensi;
use App\Models\Pandita;
use App\Models\DataPelita;
use App\Models\Daftarkelas;
use App\Models\Groupvihara;


if(!function_exists('tgl')) {

      function tgl() {
            return now()->toDateString();
      }
}

if(!function_exists('check_JK')) {


      function check_JK($jk, $umur) {
            if ($jk == '1' && $umur <= 16) return "童";
            else if ($jk == '1' && $umur > 16) return "乾";
            else if ($jk == '2' && $umur <= 16) return "女";
            else return "坤";
            // if ($jk == 1 && $umur <= 16) return "童 - Anak Laki-Laki";
            // else if ($jk == 1 && $umur > 16) return "乾 - Laki-Laki";
            // else if ($jk == 2 && $umur <= 16) return "女 - Anak Perempuan";
            // else return "坤 - Perempuan";
        }
}

function checkGender($id) {
    if($id != '') {
        $gender = DataPelita::find($id);
        try {
        if ($gender->gender == '1') {
            return '1';
        }else {
            return '2';
        }
      } catch (\Exception $e) {
        return $e->getMessage();
}
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
    //   function getNamaBranch() {

    //         return 'hello';
    //         // return $branch->nama_branch;
    //   }

            function getBranch($id) {
            if($id != '') {
                $data = Branch::find($id);
                return $data->nama_branch;
            }
            else{
                return '';
            }
        }

      function getName($id) {
        try {
          $data = DataPelita::find($id);
          return $data->nama_umat;

        } catch (\Exception $e) {
             return $e->getMessage();
}
      }

      function getGroupVihara($id) {
        if($id != null ){
            $data = Groupvihara::find($id);
            return $data->nama_group;
        } else{
            return '';
        }


        }
        function check_is_peserta_terdaftar($datapelita_id , $daftarkelas_id ){
            $data = Absensi::where('datapelita_id', $datapelita_id)->where('daftarkelas_id', $daftarkelas_id)->first();

            try {

                return $data->id;
            } catch (\Exception $e) {
                return null;
    }


        }

        function check_daftarkelas_is_used($id){
        $data =  Absensi::where('daftarkelas_id', $id)->first();
        try {

            return $data->daftarkelas_id;
        } catch (\Exception $e) {
            return null;
}
        }

      function getKelas($id) {
        $data = Kelas::find($id);
        return $data->nama_kelas;
      }

      function getDaftarKelas($id) {
        if($id != null) {
            $kelas_id = Daftarkelas::find($id);
            try {
                $nama_kelas = Kelas::find($kelas_id->kelas_id);
                return $nama_kelas->nama_kelas;
            } catch (\Exception $e) {
                 return $e->getMessage();
   }



        }

      }

      function getDaftarKelasCetya($id) {
        $branch_id = Daftarkelas::find($id);

        $nama_branch = Branch::find($branch_id->branch_id);
        return $nama_branch->nama_branch;

      }

      function getNamaKota($id){
        try {

            $kota_id = Kota::find($id);
            return $kota_id->nama_kota;
        }catch (\Exception $e) {
            return 'Tidak ada Data Absensi Dalam Database';
            //   return $e->getMessage();
          }
      }

      function getNamaPandita($id){
        try {
        $pandita_id = Pandita::find($id);
        return $pandita_id->nama_pandita;
        }catch (\Exception $e) {
        return 'Tidak ada Data Absensi Dalam Database';
            //   return $e->getMessage();
          }
      }

      function getNamaKelas($id) {
        try {

            $daftarkelas = Daftarkelas::find($id);
            $kelas = Kelas::find($daftarkelas->kelas_id);
            return $kelas->nama_kelas;
        }catch (\Exception $e) {
            return 'Tidak ada Data Absensi Dalam Database';
            //   return $e->getMessage();
          }
      }
      function tgl($tgl) {
        return date('d-m-Y', strtotime($tgl));
      }

      function getNamaCetya($id) {

        try {

            $daftarkelas = Daftarkelas::find($id);
            $cetya = Branch::find($daftarkelas->branch_id);
            return $cetya->nama_branch;

          } catch (\Exception $e) {
            return 'Tidak ada Data Absensi Dalam Database';
            //   return $e->getMessage();
          }

      }

      function hitungUmurSekarang($tgl) {
        $now = Carbon::now();
        $tahun = $now->year;
        $year = date('Y', strtotime($tgl));
        return $tahun - $year;
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
