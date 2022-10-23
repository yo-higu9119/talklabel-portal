<?php
	if($sErr !== ""){
?>
			<div class="main_ti clear_fix">
				<h1 class="bsc_ti"><span><?php echo Util::dispLang(Language::WORD_00010);/* エラー */?></span></h1>
			</div>
			<div class="popup_Box">
				<section class="CautTxt cnt mgt20">
					<p><?php echo $sErr; ?></p>
				</section>
				<div class="BtM mglra clear_fix">
					<p><button type="submit" class="whBT mgt20 mgb10 mglra btWtM close_popup" /><?php echo Util::dispLang(Language::WORD_00011);/*ウィンドウを閉じる*/?></button></p>
				</div>
			</div>
<?php
	}else{
		if($type == "ed"){//編集
			require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/comment_edit_dialog.php';
		}else if($type == "de"){//削除
			require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/comment_del_dialog.php';
		}else if($type == "rs"){//コメント返信
			if($id == 0){
				require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/comment_send_dialog.php';
			}else{
				require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/comment_res_dialog.php';
			}
		}else if($type == "rp"){//通報
			require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/comment_rep_dialog.php';
		}else if($type == "brp"){//通報
			require dirname(__FILE__).'/../../../../core_sys/inc/sys/board/board_rep_dialog.php';
		}
	}
?>
