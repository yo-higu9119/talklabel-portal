			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00347);/*新規サービスの購入*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
					<table>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00351);/*選択済みサービス*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php echo $itemInfo->name; ?></td>
						</tr>
					</table>
				</section>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_select_bt.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_mypage_sv_input.php';?>

			</div>
