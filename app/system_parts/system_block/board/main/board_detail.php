					<section class="board clear_fix">
						<div class="boardList clear_fix">
							<div class="boardArea clear_fix">
<?php if($info->commentAuthDefoult == 1){/*------*/ ?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/board_topics.php';?>

<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/board_comment.php';?>
<?php } else {/*------*/ ?>
<?php require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/unapproved.php';?>
<?php }/*------*/ ?>
								<div class="BtM mgt30 mgb30">
									<p><a href="javascript:void(0);" id="commentTop" name="commentTop" class="whBT mglra btWtM back" onclick="location.href='./?c=<?php echo $categoryId; ?>'"><?php echo Util::dispLang(Language::WORD_00140);/*掲示板一覧に戻る*/?></a></p>
								</div>

<?php if (IS_SMART_PHONE) { ?>
<?php if ($session->isLogin()) { ?>
								<div class="BtM mgt30 mgb30">
									<p class="inbox"><a href="<?php echo SYSTEM_TOP_URL; ?>community/board/input.php?b=0<?php echo $addParam; ?>" class="orBT mglra btWtM next fontFace"><?php echo Util::dispLang(Language::WORD_00138);/*新規トピックス投稿*/?></a></p>
								</div>
<?php } ?>
<?php } else { ?>
<?php } ?>
							</div>
						</div>
					</section>
