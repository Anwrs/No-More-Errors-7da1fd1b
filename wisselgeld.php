<?php 

$ar = $argv[1];

try {
    if(empty($ar)) {
        throw new Exception("geen bedrag meegegeven dat omgewisseld dient te worden.");
        } elseif($ar < "0"){
        throw new Exception("een negatief getal meegegeven");
        } elseif(!is_numeric($ar)) {
        throw new Exception ("geen geldig bedrag meegegeven.");
        }elseif(is_numeric($ar)){

        $wsgeld = (float) round($ar, 2);
        $wsgeld = (round($wsgeld / 0.05, 0)) * 0.05;

        define(
                'geldEenheid',
                [
                    "50"=>"euro", 
                    "20"=>"euro", 
                    "10"=>"euro", 
                    "5"=>"euro", 
                    "2"=>"euro", 
                    "1"=>"euro",
                    "0.50"=>"cent", 
                    "0.20"=>"cent", 
                    "0.10"=>"cent",
                    "0.05"=>"cent"
                ]
            );

        foreach(geldEenheid as $coin => $type){
            $coin = (float) $coin;
            $wsgeld = round($wsgeld, 2);

            if(floor($wsgeld / $coin) > 0){
                $times = floor($wsgeld / $coin);
                echo "$times X $coin $type" . PHP_EOL;
                $wsgeld = $wsgeld - ($times * $coin);
            }
        }
    }
}

catch (Exception $ex) {
    echo "Helaas, je hebt " . $ex->getMessage();
    exit;
}
