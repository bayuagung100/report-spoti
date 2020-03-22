<?php
//server
// $servername = "localhost";
// $username = "u328098603_spoti";
// $password = "bayuagung123";
// $database = "u328098603_spoti";

//remote server
$servername = "sql261.main-hosting.eu";
$username = "u328098603_spoti";
$password = "bayuagung123";
$database = "u328098603_spoti";

//localpc
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "reports";
 
// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);


function base_url($var)
{
    // $url = "http://localhost/merajut-nusantara/".$var;
    // $url = "http://merajutnusantara2020.com/".$var;
    // return $url;

    $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $url .= "://" . $_SERVER['HTTP_HOST'];
    $url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $url .= $var;
    return $url;
}
function dirToArray($dir) {
    
    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            }
            // else
            // {
            //     $result[] = $value;
            // }
        }
    }

    var_dump($result);
}

// function node_modules($path, $file)
// {
//     $dir    = './node_modules';
//     $parent = scandir($dir);

//     $ttlparent = count($parent);
    
//     for ($i=2; $i < $ttlparent; $i++) { 
//         // var_dump($parent[$i]);

//         // $subdir = subdir($dir."/".$parent[$i]);
//         $checkdir = $dir . DIRECTORY_SEPARATOR . $parent[$i];

//         if (is_dir($checkdir)){
//             // var_dump($checkdir);
//             $subdir = $checkdir;
//             $subparent = scandir($subdir);
//             $ttlsubparent = count($subparent);

//             for ($j=2; $j < $ttlsubparent; $j++) {
//                 $checksubdir = $subdir . DIRECTORY_SEPARATOR . $subparent[$j];
//                 if (is_dir($checksubdir)){
//                     $ex = explode("/", $checksubdir);
//                     $exsub = $ex[3];
//                     if ($exsub == $path) {
//                         var_dump($checksubdir.DIRECTORY_SEPARATOR.$file);
//                     }
                    
//                 }
//             }
            

            
//         }

        
//     }
//     // foreach ($parent as $key => $value) {
//     //     $result = $value;

//     //     var_dump($result);
//     // }
    
    
// }

// function subdir($var)
// {
//     $subdir = $var;
//     $subparent = scandir($subdir);
//     $ttlsubparent = count($subparent);

//     if (is_dir($subdir . DIRECTORY_SEPARATOR . $value)){

//     }
 

//     var_dump ($subparent[2]);

// }



//Menentukan timezone //
date_default_timezone_set('Asia/Jakarta'); 

//Membuat variabel yang menyimpan nilai waktu //
$nama_hari 	= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari		= date("w");
$hari_ini 	= $nama_hari[$hari];

$tgl_sekarang = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");

$tanggal 	= date("Y-m-d");  
$jam 		= date("H:i:s");

// $query = $mysqli->query("SELECT * FROM setting");
// $set = $query->fetch_array();

$sesi = session_id();
$sesi_id_user = isset($_SESSION['id']);


function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit)).' ...';
}	
function convert_seo($kata) {
    $simbol = array ('-','/','\\',',','.','#',':',';','\',','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	
	//Menghilangkan simbol pada array $simbol
    $kata = str_replace($simbol, '', $kata); 
	//Ubah ke huruf kecil dan mengganti spasi dengan (-)
    $kata = strtolower(str_replace(' ', '-', $kata)); 
    
	return $kata;
}






?> 
