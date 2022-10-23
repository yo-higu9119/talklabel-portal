			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00352);/*購入サービスのプラン変更*/?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="ordDetBox">
					<table>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00308);/*購入済みサービス*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php echo $nowItemInfo->name; ?></td>
						</tr>
						<tr>
							<th><?php echo Util::dispLang(Language::WORD_00353);/*変更後サービス*/?></th>
<?php if (IS_SMART_PHONE) { ?>
						</tr>
						<tr>
<?php } else { ?>
<?php } ?>
							<td><?php echo $nexItemInfo->name; ?></td>
						</tr>
					</table>
				</section>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_select_bt.php';?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/payment/pay_mypage_sv_change.php';?>

			</div>
