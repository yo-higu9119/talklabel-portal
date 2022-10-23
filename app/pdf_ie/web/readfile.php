<?php
require_once dirname(__FILE__).'/../../../common/inc/data/system_info.php';
require_once dirname(__FILE__).'/../../../common/inc/data/path_info.php';
require Config::AWS_DIR.'/autoload.php';
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

require_once dirname(__FILE__).'/../../core_sys/inc/util/session.php';
$session = new Session(true);
require_once dirname(__FILE__).'/../../core_sys/inc/sys/common/session_check.php';

$pdf_path = "";
if(isset($_GET["i"])){
	$pdf_path = $_GET["i"];
}
if($pdf_path !== ""){
	$systemData = new SystemData('');
	$systemInfo = $systemData->getInfo();
	if($systemInfo->elf_action_flg == 2 || $systemInfo->elf_action_flg == 3){
		$aws_url = str_replace($systemInfo->s3_elf_aws_url,"",$pdf_path);
		if($pdf_path !== $aws_url){
			if($systemInfo->elf_action_flg == 2 || $systemInfo->elf_action_flg == 3){
				$aws_config = [
				    "key" => $systemInfo->s3_elf_key,
				    "secret" => $systemInfo->s3_elf_secret,
				    "region" => $systemInfo->s3_elf_region,
				    "bucket" => $systemInfo->s3_elf_bucket
				];
				
				$client = new S3Client(
					Array ( "driver" => "s3",
						"key" => $systemInfo->s3_elf_key,
						"secret" => $systemInfo->s3_elf_secret,
						"region" => $systemInfo->s3_elf_region,
						"bucket" => $systemInfo->s3_elf_bucket,
						"url" => $systemInfo->s3_elf_aws_url,
						"version" => "latest",
						"credentials" => Array (
							"key" => $systemInfo->s3_elf_key,
							"secret" => $systemInfo->s3_elf_secret
						)
					)
				);
				$client->registerStreamWrapper();
				
				$stream = fopen('s3://'.$systemInfo->s3_elf_bucket.'/'.$aws_url, 'r');
				if (FALSE === $stream) {
					exit("Failed to open.");
				}
				
				header('Content-Type: application/pdf');
				while (!feof($stream)) {
					echo fread($stream, 1024);
				}
				fclose($stream);
			}
		}else{
			header('Content-Type: application/pdf');
			readfile($pdf_path);
		}
	}else{
		header('Content-Type: application/pdf');
		readfile($pdf_path);
	}
}
?>