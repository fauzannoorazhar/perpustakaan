<?php

namespace app\components;
/*namespace backend\components;*/
/*use app\components\Helper;*/

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Helper extends Component
{
 	public static function rp($jumlah,$null=null)
	{
		$jumlah = str_replace(' ', '', $jumlah);
		$jumlah = str_replace('.', '', $jumlah);
		$jumlah = str_replace(',', '', $jumlah);
		if($jumlah==null)
		{
			return $null;
		} elseif(is_integer($jumlah)) {
			return number_format($jumlah,0,',','.');
		} else {
			return number_format($jumlah,0,',','.');
		}
	}

	public static function getTanggalSingkat($tanggal)
	{
		/*Helper::getTanggalSingkat($model->tanggal_lahir);*/
		if($tanggal==null)
			return null;

		if($tanggal=='0000-00-00')
			return null;

		$time = strtotime($tanggal);

		return date('j',$time).' '.Helper::getBulanSingkat(date('m',$time)).' '.date('Y',$time);
	}

	public static function getTanggal($tanggal)
	{
		if($tanggal==null)
			return null;

		if($tanggal=='0000-00-00')
			return null;

		$time = strtotime($tanggal);

		return date('j',$time).' '.Helper::getBulanLengkap(date('m',$time)).' '.date('Y',$time);
	}

	public static function getBulanSingkat($i)
	{
		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		if($i=='01') $bulan = 'Jan';
		if($i=='02') $bulan = 'Feb';
		if($i=='03') $bulan = 'Mar';
		if($i=='04') $bulan = 'Apr';
		if($i=='05') $bulan = 'Mei';
		if($i=='06') $bulan = 'Jun';
		if($i=='07') $bulan = 'Jul';
		if($i=='08') $bulan = 'Agt';
		if($i=='09') $bulan = 'Sep';
		if($i=='10') $bulan = 'Okt';
		if($i=='11') $bulan = 'Nov';
		if($i=='12') $bulan = 'Des';

		return $bulan;

	}

	/*public static function getBulanLengkap($i)
	{
		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		switch ($i) {
			case ('01') 
				$bulan = 'Januari';
				break;
			case ('02') 
				$bulan = 'Februari';
				break;
			case ('03') 
				$bulan = 'Maret';
				break;
			case ('04') 
				$bulan = 'April';
				break;
			case ('05') 
				$bulan = 'Mei';
				break;
			case ('06') 
				$bulan = 'Juni';
				break;
			case ('07') 
				$bulan = 'Juli';
				break;
			case ('08') 
				$bulan = 'Agustus';
				break;
			case ('09') 
				$bulan = 'September';
				break;
			case ('10') 
				$bulan = 'Oktober';
				break;
			case ('11') 
				$bulan = 'November';
				break;
			case ('12') 
				$bulan = 'Desember';
				break;
			default
				$bulan = null;
				break
		}

		return $bulan;

	}*/

	public static function getBulanLengkap($i)
	{
		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		if($i=='01') $bulan = 'Januari';
		if($i=='02') $bulan = 'Februari';
		if($i=='03') $bulan = 'Maret';
		if($i=='04') $bulan = 'April';
		if($i=='05') $bulan = 'Mei';
		if($i=='06') $bulan = 'Juni';
		if($i=='07') $bulan = 'Juli';
		if($i=='08') $bulan = 'Agustus';
		if($i=='09') $bulan = 'September';
		if($i=='10') $bulan = 'Oktober';
		if($i=='11') $bulan = 'November';
		if($i=='12') $bulan = 'Desember';

		return $bulan;

	}

	public static function getWaktuWIB($waktu)
	{
		if($waktu == '')
			return null;
		else {
		$time = strtotime($waktu);
		
		$h = date('N',$time);
		
		if($h == '1') $hari = 'Senin';
		if($h == '2') $hari = 'Selasa';
		if($h == '3') $hari = 'Rabu';
		if($h == '4') $hari = 'Kamis';
		if($h == '5') $hari = 'Jumat';
		if($h == '6') $hari = 'Sabtu';
		if($h == '7') $hari = 'Minggu';
		
		
		$tgl = date('j',$time);
		
		$h = date('n',$time);
		
		if($h == '1') $bulan = 'Januari';
		if($h == '2') $bulan = 'Februari';
		if($h == '3') $bulan = 'Maret';
		if($h == '4') $bulan = 'April';
		if($h == '5') $bulan = 'Mei';
		if($h == '6') $bulan = 'Juni';
		if($h == '7') $bulan = 'Juli';
		if($h == '8') $bulan = 'Agustus';
		if($h == '9') $bulan = 'September';
		if($h == '10') $bulan = 'Oktober';
		if($h == '11') $bulan = 'November';
		if($h == '12') $bulan = 'Desember';
		
		$tahun  = date('Y',$time);
		
		$pukul = date('H:i:s',$time);
		
		$output = $hari.', '.$tgl.' '.$bulan.' '.$tahun.' | '.$pukul.' WIB';
		
		return $output;
		}
		
	}

	public function getBulanList()
	{
		$bulan = [];
		$i = 1;
		while ($i <= 12) {
			if (strlen($i) == 1) $i = '0'.$i;

			$bulan[$i] = self::getBulanLengkap($i);
			$i++;
		}

		return $bulan;
	}

	public function getBulanListFilter()
	{
		$bulan = [];
		$i = 1;
		while ($i <= 12) {
			if (strlen($i) == 1) $i = '0'.$i;

			$bulan[$i] = self::getBulanLengkap($i);
			$i++;
		}
		
		return $bulan;
	}

    public static function getKodePin()
    {
        //removed number 0, capital o, number 1 and small L
        //Total: keys = 32, elements = 33
        $characters = array(
            "A","B","C","D","E","F","G","H","J","K","L","M",
            "N","P","Q","R","S","T","U","V","W","X","Y","Z",
            "1","2","3","4","5","6","7","8","9");

        //make an "empty container" or array for our keys
        $keys = array();

        //first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
        while(count($keys) < 6) {
        //"0" because we use this to FIND ARRAY KEYS which has a 0 value
        //"-1" because were only concerned of number of keys which is 32 not 33
        //count($characters) = 33
            $x = mt_rand(0, count($characters)-1);
            if(!in_array($x, $keys)) {
                $keys[] = $x;
            }
        }
        
        $random_chars='';
    
        foreach($keys as $key){
            $random_chars .= $characters[$key];
        }
        
        return $random_chars;   
    
    }
 
}

?>