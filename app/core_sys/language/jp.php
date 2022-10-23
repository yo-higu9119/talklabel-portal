<?php
/* 言語ファイル */
/*
記述方法：「const WORD_XXXXX = '';」の定型で記述。
　　　　　XXXXXに番号を５桁の０詰めにて指定する。
　　　　　「''」の間に文章を記述。
　　　　　文章内に「’」がある場合は\'と記述します。
　　　　　例）const WORD_00001 = 'この文章は\'定型\'です。';
設置方法：<?php echo Util::dispLang(Language::WORD_00001)?>
*/

class LanguageCommon {
	const SYS_WORD_00001 = '8文字以上の数字+英字';
	const SYS_WORD_00002 = '8文字以上の数字+英字（小文字）+英字（大文字）';
	const SYS_WORD_00003 = '8文字以上の数字+英字+記号';
	const SYS_WORD_00004 = '8文字以上の数字+英字（小文字）+英字（大文字）+記号';
	const SYS_WORD_00005 = '8文字以上の英数字';
	const SYS_WORD_00006 = 'パスワード強度';
	const SYS_WORD_00007 = '※他サイトで利用しているパスワードと同一のパスワードを設定するのは、危険なので避けてください。';
	const SYS_WORD_00008 = '必須です。';
	const SYS_WORD_00009 = '8文字以上で入力してください';
	const SYS_WORD_00010 = 'すでに登録されています';
	const SYS_WORD_00011 = '半角の数字+英字で入力して下さい';
	const SYS_WORD_00012 = '半角の数字+英字（小文字）+英字（大文字）で入力して下さい';
	const SYS_WORD_00013 = '半角の数字+英字+記号で入力して下さい';
	const SYS_WORD_00014 = '半角の数字+英字（小文字）+英字（大文字）+記号で入力して下さい';
	const SYS_WORD_00015 = '半角英数字で入力して下さい';
	const SYS_WORD_00016 = '8文字以上、16文字以下で入力して下さい。';
	const SYS_WORD_00017 = '権限を選択して下さい';
	const SYS_WORD_00018 = '送信先メールアドレス';
	const SYS_WORD_00019 = '問い合わせ日時';
	const SYS_WORD_00020 = 'リマインダーURL';
	const SYS_WORD_00021 = 'リマインダーURLキー';
	const SYS_WORD_00022 = 'リマインダーURLキー有効期限(日時)';
	const SYS_WORD_00023 = 'リマインダーURLキー有効期限(時間)';
	const SYS_WORD_00024 = 'サイトURL';
	const SYS_WORD_00025 = '管理者';
	const SYS_WORD_00026 = '編集者';
	const SYS_WORD_00027 = '投稿者';
	const SYS_WORD_00028 = 'ほぼ全ての操作が可能です';
	const SYS_WORD_00029 = '主に記事操作に関係する全ての操作が可能です';
	const SYS_WORD_00030 = '記事の投稿に関係する操作が可能です';
	const SYS_WORD_00031 = '公開中';
	const SYS_WORD_00032 = '退会';
	const SYS_WORD_00033 = '削除';
	const SYS_WORD_00034 = '未承認';
	const SYS_WORD_00035 = '承認済';
	const SYS_WORD_00036 = '承認拒否';
	const SYS_WORD_00037 = '受付拒否';
	const SYS_WORD_00038 = '受付中';
	const SYS_WORD_00039 = '1行フィールド';
	const SYS_WORD_00040 = '複数行フィールド';
	const SYS_WORD_00041 = 'ラジオボタン';
	const SYS_WORD_00042 = 'チェックボックス';
	const SYS_WORD_00043 = 'プルダウン';
	const SYS_WORD_00044 = '郵便番号フィールド';
	const SYS_WORD_00045 = '都道府県';
	const SYS_WORD_00046 = '住所フィールド';
	const SYS_WORD_00047 = '日付フィールド';
	const SYS_WORD_00048 = '電話番号フィールド';
	const SYS_WORD_00049 = '画像アップロード';
	const SYS_WORD_00050 = 'マスタ連動';
	const SYS_WORD_00051 = 'メールの送信に失敗しました';
	const SYS_WORD_00052 = '件表示';
	const SYS_WORD_00053 = '件中';
	const SYS_WORD_00054 = '件';
	const SYS_WORD_00055 = '※使用できる記号は下記記号のみです。';
	const SYS_WORD_00056 = '# $ % & – . _ +';
	
	const WORD_00001 = 'コンテンツ';
	const WORD_00002 = 'ランキング';
	const WORD_00003 = '検索結果';
	const WORD_00004 = '全ての記事';
	const WORD_00005 = 'コンテンツ一覧に戻る';
	const WORD_00006 = 'その他の関連記事';
	const WORD_00007 = 'タグ';
	const WORD_00008 = '前の記事';
	const WORD_00009 = '次の記事';
	const WORD_00010 = 'エラー';
	const WORD_00011 = 'ウィンドウを閉じる';
	const WORD_00012 = 'アクセス情報が不正です';
	const WORD_00013 = 'コメント編集の最終確認';
	const WORD_00014 = 'コメントを編集しても良いですか？';
	const WORD_00015 = '編集しない';
	const WORD_00016 = '編集する';
	const WORD_00017 = 'この記事へのコメント';
	const WORD_00018 = 'ニックネームを入れてください';
	const WORD_00019 = 'コメントを入力してください';
	const WORD_00020 = 'コメントする';
	const WORD_00021 = 'コメント削除の最終確認';
	const WORD_00022 = 'コメントを削除しても良いですか？';
	const WORD_00023 = '削除しない';
	const WORD_00024 = '削除する';
	const WORD_00025 = 'コメントするには会員登録が必要です';
	const WORD_00026 = '会員登録はこちら';
	const WORD_00027 = '通報コメント投稿の最終確認';
	const WORD_00028 = '通報コメントを投稿しても良いですか？';
	const WORD_00029 = '通報しない';
	const WORD_00030 = '通報する';
	const WORD_00031 = '返信コメント投稿の最終確認';
	const WORD_00032 = '返信コメントを投稿しても良いですか？';
	const WORD_00033 = '投稿しない';
	const WORD_00034 = '投稿する';
	const WORD_00035 = 'コメント投稿の最終確認';
	const WORD_00036 = 'コメントを投稿しても良いですか？';
	const WORD_00037 = '投稿しない';
	const WORD_00038 = '投稿する';
	const WORD_00039 = '削除されました';
	const WORD_00040 = '現在、閲覧できません';
	const WORD_00041 = '承認待ちです';
	const WORD_00042 = '承認が拒否されました';
	const WORD_00043 = '返信';
	const WORD_00044 = '共感する';
	const WORD_00045 = '通報しました';
	const WORD_00046 = '返信する';
	const WORD_00047 = 'このコメントを削除しますか？';
	const WORD_00048 = '返信のコメントする';
	const WORD_00049 = '通報理由を入力してください';
	const WORD_00050 = '匿名希望';
	const WORD_00051 = '返信しない';/* JS用 */
	const WORD_00052 = '通報しない';/* JS用 */
	const WORD_00053 = '通報する';/* JS用 */
	const WORD_00054 = '削除しない';/* JS用 */
	const WORD_00055 = 'コメントしない';/* JS用 */
	const WORD_00056 = 'コメントが入力されていません';
	const WORD_00057 = '通報内容が入力されていません';
	const WORD_00058 = '必須';
	const WORD_00059 = '任意';
	const WORD_00060 = '上記入力内容で問題ありませんか？';
	const WORD_00061 = '問題なければ下記「入力内容の確認」ボタンをクリックして進んでください。';
	const WORD_00062 = '問題なければ下記「登録を完了する」ボタンをクリックして完了してください。';
	const WORD_00063 = '入力内容の確認';
	const WORD_00064 = '前の画面に戻る';
	const WORD_00065 = '登録を完了する';
	const WORD_00066 = 'いいねをする';
	const WORD_00067 = 'この記事を書いた人';
	const WORD_00068 = '他のサービスIDでログイン';
	const WORD_00069 = 'facebookでログイン';
	const WORD_00070 = 'twitterでログイン';
	const WORD_00071 = 'LINEでログイン';
	const WORD_00072 = '閲覧履歴・購入履歴等はタイムラインに反映されませんので、ご安心ください。';
	const WORD_00073 = 'ログイン';
	const WORD_00074 = 'ログインする';
	const WORD_00075 = 'パスワードを忘れた方はこちら';
	const WORD_00076 = '新規無料会員登録';
	const WORD_00077 = 'ID(メールアドレス)';
	const WORD_00078 = 'パスワード';
	const WORD_00079 = '言語選択';
	const WORD_00080 = 'IDまたはパスワードが違います。';
	const WORD_00081 = '会員が登録されていません。';
	const WORD_00082 = 'Facebookアカウントに紐付けされていません。';
	const WORD_00083 = 'LINEアカウントに紐付けされていません。';
	const WORD_00084 = 'ログアウトしました。';
	const WORD_00085 = '無料会員';
	const WORD_00086 = '有料会員';
	const WORD_00087 = '入力してください。';
	const WORD_00088 = 'パスワードを忘れた方へ';
	const WORD_00089 = '登録時のメールアドレスを入力の上、「パスワード問合わせ」ボタンをクリックしてください。';
	const WORD_00090 = 'メールアドレス';
	const WORD_00091 = 'パスワード問合わせ';
	const WORD_00092 = 'メールを送信いたしました。';
	const WORD_00093 = '入力されたメールアドレス宛にパスワード再設定メールを送信いたしました。';
	const WORD_00094 = '送信されるメールの案内に従って、パスワードを再設定してください。';
	const WORD_00095 = 'パスワードの再設定';
	const WORD_00096 = '新しいパスワードを設定してください。';
	const WORD_00097 = 'パスワードは必須です';
	const WORD_00098 = 'パスワード再設定';
	const WORD_00099 = 'パスワード再設定完了';
	const WORD_00100 = 'パスワード再設定が完了しました';
	const WORD_00101 = 'パスワードの再設定が完了いたしました。';
	const WORD_00102 = 'マイページへ進む';
	const WORD_00103 = '新規会員登録';
	const WORD_00104 = '情報入力';
	const WORD_00105 = '基本情報を入力してください';
	const WORD_00106 = '内容確認';
	const WORD_00107 = '内容の確認をしてください';
	const WORD_00108 = '登録完了';
	const WORD_00109 = '登録完了しました';
	const WORD_00110 = 'その他補足項目';
	const WORD_00111 = '新規登録が完了しました';
	const WORD_00112 = 'メールの送信に失敗しました';
	const WORD_00113 = '登録に失敗しました';
	const WORD_00114 = '入力内容に間違いがあります';
	const WORD_00115 = '新規会員登録完了';
	const WORD_00116 = '会員登録が完了いたしました';
	const WORD_00117 = 'あなたの会員番号は下記になります。';
	const WORD_00118 = 'カート';
	const WORD_00119 = 'マイページ';
	const WORD_00120 = 'ログアウト';
	const WORD_00121 = 'ログイン';
	const WORD_00122 = '新規会員登録';
	const WORD_00123 = 'マイページトップ';
	const WORD_00124 = 'お知らせ';
	const WORD_00125 = '基本情報の編集';
	const WORD_00126 = 'サービス購入履歴';
	const WORD_00127 = 'セミナー申込履歴';
	const WORD_00128 = '商品購入履歴';
	const WORD_00129 = 'お問い合わせ履歴';
	const WORD_00130 = 'いいね・投稿履歴';
	const WORD_00131 = '会員特典';
	const WORD_00132 = '紹介制度';
	const WORD_00133 = '更新日時';
	const WORD_00134 = 'アクセス数順';
	const WORD_00135 = 'いいね数順';
	const WORD_00136 = 'コメント数順';
	const WORD_00137 = '投稿日';
	const WORD_00138 = '新規トピックス投稿';
	const WORD_00139 = '全ての掲示板';
	const WORD_00140 = '掲示板一覧に戻る';
	const WORD_00141 = 'トピックス投稿には会員登録が必要です';
	const WORD_00142 = 'トピックスタイトルを入れてください';
	const WORD_00143 = '新規投稿する';
	const WORD_00144 = '続きを見る';
	const WORD_00145 = '投稿者';
	const WORD_00146 = '最初';
	const WORD_00147 = '最後';
	const WORD_00148 = 'トピックスの登録が完了しました';
	const WORD_00149 = 'カテゴリの登録に失敗しました';
	const WORD_00150 = 'ブラウザの更新ボタンがクリックされました。一度画面を閉じて再度登録内容をご確認ください。';
	const WORD_00151 = 'コメントは一件もありません';
	const WORD_00152 = 'セミナー一覧';
	const WORD_00153 = 'セミナー';
	const WORD_00154 = 'セミナーカレンダー';
	const WORD_00155 = '現在開催はありません';
	const WORD_00156 = '会場未定';
	const WORD_00157 = 'オンライン';
	const WORD_00158 = '開催日';
	const WORD_00159 = '常時開催';
	const WORD_00160 = '販売価格';
	const WORD_00161 = '円(税込)';
	const WORD_00162 = '無料';
	const WORD_00163 = '開催場所';
	const WORD_00164 = '申込期間';
	const WORD_00165 = '申込期限なし';
	const WORD_00166 = '空き状況';
	const WORD_00167 = '空きあり';
	const WORD_00168 = 'あとわずか';
	const WORD_00169 = 'キャンセル待ち';
	const WORD_00170 = '満席';
	const WORD_00171 = '受付終了';
	const WORD_00172 = '出席';
	const WORD_00173 = '欠席';
	const WORD_00174 = '申込中';
	const WORD_00175 = 'キャンセル';
	const WORD_00176 = 'セミナー一覧に戻る';
	const WORD_00177 = 'セミナーカレンダー';
	const WORD_00178 = 'セミナー詳細';
	const WORD_00179 = '申込み';
	const WORD_00180 = '種類';
	const WORD_00181 = '名称';
	const WORD_00182 = '日程';
	const WORD_00183 = '会場';
	const WORD_00184 = '申込金額';
	const WORD_00185 = '状況';
	const WORD_00186 = '詳細';
	const WORD_00187 = '現在開催はありません。';
	const WORD_00188 = '開催日程が決まるまでもうしばらくお待ちください。';
	const WORD_00189 = '住所';
	const WORD_00190 = '常時受付中';
	const WORD_00191 = '定員';
	const WORD_00192 = '名';
	const WORD_00193 = '現在空き状況に余裕がございます。';
	const WORD_00194 = '興味をお持ちの方はお早目にお申込みください。';
	const WORD_00195 = '残席がなくなりました。';
	const WORD_00196 = '現在キャンセル待ちとして申込みが可能です。';
	const WORD_00197 = '席の確保が出来次第、ご連絡させていただきますので興味をお持ちの方はお早めにお申込みください。';
	const WORD_00198 = '既に申込みされています。';
	const WORD_00199 = '申込内容はマイページよりご確認ください。';
	const WORD_00200 = '残席あとわずかとなりました。';
	const WORD_00201 = 'このセミナーには申し込むことができません。';
	const WORD_00202 = '受付を終了いたしました。';
	const WORD_00203 = 'たくさんの申込みありがとうございました。';
	const WORD_00204 = '既に他の時間帯で申込みされています。';
	const WORD_00205 = '申込には会員登録が必要です。';
	const WORD_00206 = '満席になりました。';
	const WORD_00207 = 'キャンセル待ちで申込む';
	const WORD_00208 = '今すぐ申込みへ進む';
	const WORD_00209 = 'マイページはこちらから';
	const WORD_00210 = '既に会員登録がお済みの方は会員ログインをしてください';
	const WORD_00211 = 'セミナータグ一覧';
	const WORD_00212 = 'タグ検索';
	const WORD_00213 = 'その他のコンテンツを見る';
	const WORD_00214 = 'キーワード検索';
	const WORD_00215 = '検索';
	const WORD_00216 = '申込み手続き';
	const WORD_00217 = '選択内容';
	const WORD_00218 = '個人情報';
	const WORD_00219 = '決済情報';
	const WORD_00220 = '最終確認';
	const WORD_00221 = '申込完了';
	const WORD_00222 = '内容をご確認ください';
	const WORD_00223 = '必要事項を入力してください';
	const WORD_00224 = '申込内容を確認してください';
	const WORD_00225 = '申込完了しました';
	const WORD_00226 = '選択内容を確認してください';
	const WORD_00227 = '上記選択内容で問題ありませんか？';
	const WORD_00228 = '問題なければ「次へ進む」ボタンをクリックして進んでください。';
	const WORD_00229 = '次へ進む';
	const WORD_00230 = '個人情報を入力してください';
	const WORD_00231 = '上記内容で問題ありませんか？';
	const WORD_00232 = '支払い方法を選択';
	const WORD_00233 = '(銀行振込を選択された方へ)';
	const WORD_00234 = '問題なければ「最終確認へ進む」ボタンをクリックして進んでください。';
	const WORD_00235 = '(クレジットカードを選択された方へ)';
	const WORD_00236 = 'カード情報を入力する';
	const WORD_00237 = 'カード番号';
	const WORD_00238 = 'ハイフン無し数字で入力してください';
	const WORD_00239 = 'カード名義人';
	const WORD_00240 = 'ローマ字で入力してください';
	const WORD_00241 = '有効期限';
	const WORD_00242 = '月';
	const WORD_00243 = '年';
	const WORD_00244 = 'セキュリティコード';
	const WORD_00245 = 'セキュリティコードを入力してください';
	const WORD_00246 = '利用出来るカードブランド';
	const WORD_00247 = 'セキュリティコードについて';
	const WORD_00248 = '決済会社について';
	const WORD_00249 = '本決済はPAY.JPを利用して決済しております。';
	const WORD_00250 = 'カード番号が入力されていません。';
	const WORD_00251 = 'カード番号に半角数字以外が入力されています。';
	const WORD_00252 = 'カード名義人が入力されていません。';
	const WORD_00253 = 'カード名義人に半角英大字以外が入力されています。';
	const WORD_00254 = '有効期限(月)が入力されていません。';
	const WORD_00255 = '有効期限(月)に半角数字以外が入力されています。';
	const WORD_00256 = '有効期限(年)が入力されていません。';
	const WORD_00257 = '有効期限(年)に半角数字以外が入力されています。';
	const WORD_00258 = 'セキュリティコードが入力されていません。';
	const WORD_00259 = 'セキュリティコードに半角数字以外が入力されています。';
	const WORD_00260 = '銀行振込';
	const WORD_00261 = 'クレジットカード';
	const WORD_00262 = '最終確認へ進む';
	const WORD_00263 = '申込内容の最終確認';
	const WORD_00264 = '支払い方法';
	const WORD_00265 = '問題なければ下記「申込を完了する」ボタンをクリックしてください。';
	const WORD_00266 = '申込を完了する';
	const WORD_00267 = '申込が完了いたしました';
	const WORD_00268 = '申込ありがとうございました。';
	const WORD_00269 = '選択された情報がありません';
	const WORD_00270 = '申込済みです';
	const WORD_00271 = '受付を行っておりません';
	const WORD_00272 = '申し込みできません';
	const WORD_00273 = '受付が終了しています';
	const WORD_00274 = 'クレジットカードが判別できません';
	const WORD_00275 = '決済方法が判別できません';
	const WORD_00276 = '会員が取得できません';
	const WORD_00277 = '会員情報の更新に失敗しました';
	const WORD_00278 = '会員情報の登録に失敗しました';
	const WORD_00279 = '情報が取得できないエラー';
	const WORD_00280 = 'カード情報が取得できません';
	const WORD_00281 = 'カード情報の確認に失敗しました';
	const WORD_00282 = 'カード情報の確認に失敗しました';
	const WORD_00283 = 'セミナーの申込ができませんでした';
	const WORD_00284 = '現在のステータス';
	const WORD_00285 = '会員ステータス';
	const WORD_00286 = '登録情報';
	const WORD_00287 = '基本情報の編集';/* ボタン用 */
	const WORD_00288 = '最終ログイン日時';
	const WORD_00289 = '連携無し';
	const WORD_00290 = '連携有り';
	const WORD_00291 = '基本情報の編集';/* タイトル用 */
	const WORD_00292 = '会員基本情報の編集フォーム';
	const WORD_00293 = 'メールアドレス等の登録情報に変更がある場合はこちらから編集してください。';
	const WORD_00294 = '入力内容の保存';
	const WORD_00295 = 'その他のセミナーを見る';
	const WORD_00296 = 'その他の商品を見る';
	const WORD_00297 = '商品';
	const WORD_00298 = 'ログイン画面に戻る';
	const WORD_00299 = 'トップページへ進む';
	const WORD_00300 = '新着コメント順';
	const WORD_00301 = '新着トピックス順';
	const WORD_00302 = 'ファイル確認';
	const WORD_00303 = 'サービス購入履歴';
	const WORD_00304 = '現在購入済みのサービスです。';
	const WORD_00305 = '現在購入済みのサービスはありません。';
	const WORD_00306 = 'その他の申込可能なサービス';
	const WORD_00307 = '現在購入できるサービスはありません。';
	const WORD_00308 = '購入済みサービス';
	const WORD_00309 = '決済履歴';
	const WORD_00310 = 'キャンセル';
	const WORD_00311 = 'プラン変更';
	const WORD_00312 = '決済種別';
	const WORD_00313 = '都度決済';
	const WORD_00314 = '料金';
	const WORD_00315 = '円（税込）';
	const WORD_00316 = '継続（毎月）決済';
	const WORD_00317 = '無料月数';
	const WORD_00318 = 'ヶ月無料';
	const WORD_00319 = '手数料';
	const WORD_00320 = '毎月料金';
	const WORD_00321 = '分割決済';
	const WORD_00322 = '合計料金';
	const WORD_00323 = '分割回数';
	const WORD_00324 = '回';
	const WORD_00325 = 'サービス説明';
	const WORD_00326 = 'サービスキャンセル';
	const WORD_00327 = 'キャンセル処理日';
	const WORD_00328 = '申込可能サービス';
	const WORD_00329 = '新規申込';
	const WORD_00330 = '決済手段';
	const WORD_00331 = '決済金額';
	const WORD_00332 = '状況';
	const WORD_00333 = '回数';
	const WORD_00334 = '決済日';
	const WORD_00335 = '初回';
	const WORD_00336 = '決済なし';
	const WORD_00337 = '銀行振込';
	const WORD_00338 = 'クレジットカード';
	const WORD_00339 = '円';
	const WORD_00340 = '決済済';
	const WORD_00341 = '未決済';
	const WORD_00342 = 'サービスのキャンセル';
	const WORD_00343 = '上記サービスをキャンセルしても問題ありませんか？';
	const WORD_00344 = '問題なければ下記「キャンセルする」ボタンをクリックしてキャンセルを完了させてください。';
	const WORD_00345 = 'キャンセルする';
	const WORD_00346 = 'サービスのキャンセルが完了いたしました。';
	const WORD_00347 = '新規サービスの申込み';
	const WORD_00348 = '上記サービスに申込しても問題ありませんか？';
	const WORD_00349 = '問題なければ下記「購入手続きに進む」ボタンをクリックしてください。';
	const WORD_00350 = '購入手続きに進む';
	const WORD_00351 = '選択済みサービス';
	const WORD_00352 = 'サービスのプラン変更';
	const WORD_00353 = '変更後サービス';
	const WORD_00354 = '上記サービスをプラン変更しても問題ありませんか？';
	const WORD_00355 = '画像一覧';
	const WORD_00356 = 'カレンダー';
	const WORD_00357 = '現在申込済みのセミナーはありません。';
	const WORD_00358 = '申込済セミナー';
	const WORD_00359 = '価格';
	const WORD_00360 = '会場なし（ビデオ講座）';
	const WORD_00361 = '決済状況';
	const WORD_00362 = '申込状況';
	const WORD_00363 = '返金日';
	const WORD_00364 = '出欠状況';
	const WORD_00365 = '結果';
	const WORD_00366 = '結果';
	const WORD_00367 = 'ビデオ会議ID';
	const WORD_00368 = 'ビデオ会議PASS';
	const WORD_00369 = 'DLファイル';
	const WORD_00370 = '現在申込済みのセミナーです。';
	const WORD_00371 = 'セミナーのキャンセル';
	const WORD_00372 = '上記セミナーをプラン変更しても問題ありませんか？';
	const WORD_00373 = 'セミナーのキャンセルが完了いたしました。';
	const WORD_00374 = '新規セミナーの申込';
	const WORD_00375 = '選択済みセミナー';
	const WORD_00376 = '上記セミナーに申込しても問題ありませんか？';
	const WORD_00377 = 'セミナーの申込が完了いたしました。';
	const WORD_00378 = '商品一覧';
	const WORD_00379 = '全ての商品';
	const WORD_00380 = '配送販売';
	const WORD_00381 = 'オンライン販売';
	const WORD_00382 = '販売期間';
	const WORD_00383 = '常時販売';
	const WORD_00384 = '販売方法';
	const WORD_00385 = '在庫';
	const WORD_00386 = '購入済';
	const WORD_00387 = '在庫あり';
	const WORD_00388 = '入荷待ち';
	const WORD_00389 = '完売';
	const WORD_00390 = '販売終了';
	const WORD_00391 = '現在販売している商品はありません。';
	const WORD_00392 = '商品タグ一覧';
	const WORD_00393 = '商品一覧に戻る';
	const WORD_00394 = '商品名';
	const WORD_00395 = '現在の在庫状況';
	const WORD_00396 = '個数';
	const WORD_00397 = 'カートへ入れる';
	const WORD_00398 = '入荷待ちでカートに入れる';
	const WORD_00399 = '購入手続き';
	const WORD_00400 = '個';
	const WORD_00401 = '商品選択';
	const WORD_00402 = '選択';
	const WORD_00403 = '購入者情報';
	const WORD_00404 = '購入者';
	const WORD_00405 = '配送先情報';
	const WORD_00406 = '配送先';
	const WORD_00407 = '決済情報';
	const WORD_00408 = '決済';
	const WORD_00409 = '最終確認';
	const WORD_00410 = '確認';
	const WORD_00411 = '購入完了';
	const WORD_00412 = '完了';
	const WORD_00413 = '商品を選択してください';
	const WORD_00414 = '購入内容を確認してください';
	const WORD_00415 = '購入完了しました';
	const WORD_00416 = '配送先を入力してください';
	const WORD_00417 = '上記内容で新しい配送先を追加しても良いですか？';
	const WORD_00418 = '問題なければ下の「新しい配送先を追加する」のボタンをクリックしてください。';
	const WORD_00419 = '住所を編集する';
	const WORD_00420 = '氏名';
	const WORD_00421 = '電話番号';
	const WORD_00422 = '住所';
	const WORD_00423 = '会社名（オプション）';
	const WORD_00424 = '住所検索';
	const WORD_00425 = '住所の削除';
	const WORD_00426 = '上記内容の配送先を削除しても良いですか？';
	const WORD_00427 = '問題なければ下の「配送先を削除する」のボタンをクリックしてください。';
	const WORD_00428 = '配送先を削除する';
	const WORD_00429 = '購入内容の最終確認';
	const WORD_00430 = '問題なければ下記「購入を完了する」ボタンをクリックしてください。';
	const WORD_00431 = '購入を完了する';
	const WORD_00432 = '郵便番号';
	const WORD_00433 = '購入が完了いたしました';
	const WORD_00434 = '購入ありがとうございました。';
	const WORD_00435 = '請求番号';
	const WORD_00436 = '注文内容';
	const WORD_00437 = '請求金額';
	const WORD_00438 = '購入日時';
	const WORD_00439 = '対応状況';
	const WORD_00440 = '発送状況';
	const WORD_00441 = '現在購入済みの商品はありません。';
	const WORD_00442 = '商品情報（購入内容の確認）';
	const WORD_00443 = 'トピックスは見つかりませんでした。';
	const WORD_00444 = 'カテゴリ選択';
	const WORD_00445 = 'ニックネーム';
	const WORD_00446 = 'トピックスタイトル';
	const WORD_00447 = 'コメント';
	const WORD_00448 = '履歴';
	const WORD_00449 = '受付日時';
	const WORD_00450 = 'お問い合わせ番号';
	const WORD_00451 = 'お問い合わせ日時';
	const WORD_00452 = '事務局からの回答日時';
	const WORD_00453 = '事務局からの回答';
	const WORD_00454 = 'ファイルアップロード';
	const WORD_00455 = 'アップロードできるファイル形式はjpg・jpeg・png・gifになります。';
	const WORD_00456 = 'アップロードする';
	const WORD_00457 = 'ファイルをアップロード中です...';
	const WORD_00458 = '画像ファイル';
	const WORD_00459 = 'アップロードの上限';
	const WORD_00460 = '注文情報';
	const WORD_00461 = '代金引換';
	const WORD_00462 = '(その他)';
	const WORD_00463 = '決済無し';
	const WORD_00464 = '注文商品';
	const WORD_00465 = '商品番号';
	const WORD_00466 = '商品型番';
	const WORD_00467 = '単価';
	const WORD_00468 = '小計';
	const WORD_00469 = '商品合計';
	const WORD_00470 = '送料';
	const WORD_00471 = '合計金額（税込）';
	const WORD_00472 = '調整金額';
	const WORD_00473 = '軽減税率（8％）';
	const WORD_00474 = '標準税率（10％）';
	const WORD_00475 = '注文に対する要望';
	const WORD_00476 = '対応中';
	const WORD_00477 = '対応済';
	const WORD_00478 = '未対応';
	const WORD_00479 = '配送済';
	const WORD_00480 = '配送完了';
	const WORD_00481 = '未配送';
	const WORD_00482 = '掲示板トピックス';
	const WORD_00483 = '掲示板コメント';
	const WORD_00484 = 'コンテンツいいね';
	const WORD_00485 = 'コンテンツコメント';
	const WORD_00486 = 'トピックス';
	const WORD_00487 = 'いいね';
	const WORD_00488 = 'コメント';
	const WORD_00489 = 'あなたが投稿した掲示板トピックス';
	const WORD_00490 = 'あなたがいいねした掲示板トピックス';
	const WORD_00491 = 'あなたがいいねした掲示板トピックスはありません。';
	const WORD_00492 = 'トピックス名';
	const WORD_00493 = '投稿日時';
	const WORD_00494 = '閲覧数';
	const WORD_00495 = 'いいね数';
	const WORD_00496 = 'コメント数';
	const WORD_00497 = '通報数';
	const WORD_00498 = 'あなたが投稿した掲示板コメント';
	const WORD_00499 = 'あなたが共感した掲示板コメント';
	const WORD_00500 = 'あなたが投稿した掲示板トピックスはありません。';
	const WORD_00501 = 'あなたが投稿した掲示板コメントはありません。';
	const WORD_00502 = 'あなたが共感した掲示板コメントはありません。';
	const WORD_00503 = 'あなたがいいねしたコンテンツ';
	const WORD_00504 = 'あなたがいいねしたコンテンツはありません。';
	const WORD_00505 = 'コンテンツ名';
	const WORD_00506 = 'いいね登録日時';
	const WORD_00507 = 'あなたが投稿したコンテンツコメント';
	const WORD_00508 = 'あなたが共感したコンテンツコメント';
	const WORD_00509 = 'あなたが投稿したコンテンツコメントはありません。';
	const WORD_00510 = 'あなたが共感したコンテンツコメントはありません。';
	const WORD_00511 = '紹介URL';
	const WORD_00512 = '振込先情報';
	const WORD_00513 = '報酬情報';
	const WORD_00514 = '会員ランクがありません';
	const WORD_00515 = 'あなたのランク';
	const WORD_00516 = '紹介者ランク';
	const WORD_00517 = '紹介報酬';
	const WORD_00518 = '1ティア報酬';
	const WORD_00519 = '固定金額指定';
	const WORD_00520 = '売上料率指定';
	const WORD_00521 = '2ティア報酬';
	const WORD_00522 = '3ティア報酬';
	const WORD_00523 = 'QRコード';
	const WORD_00524 = '振込先情報';
	const WORD_00525 = '金融機関名';
	const WORD_00526 = '金融機関コード';
	const WORD_00527 = '支店名';
	const WORD_00528 = '支店コード';
	const WORD_00529 = '※半角数字3桁でご記入ください。';
	const WORD_00530 = '※ゆうちょ銀行を登録される場合は、振込用の店名・口座番号が必要です。';
	const WORD_00531 = '口座種別';
	const WORD_00532 = '口座番号';
	const WORD_00533 = '※半角数字7桁でご記入ください。';
	const WORD_00534 = '※口座番号が7桁に満たない場合は、先頭部分に「0」を入力して、全部で7桁となるようにご入力ください。';
	const WORD_00535 = '口座名義人（カナ）';
	const WORD_00536 = '※通帳に記載された口座名義を正確に登録してください。';
	const WORD_00537 = '※名義が異なる場合、送金が遅れる可能性がございますのでご注意ください。';
	const WORD_00538 = '※入力方法は、全角カタカナ・全角英数字・全角記号（，．‐－ー／（）「」￥スペース）にてお願いいたします。';
	const WORD_00539 = '口座名義人（漢字）';
	const WORD_00540 = '報酬管理';
	const WORD_00541 = '報酬トータル';
	const WORD_00542 = '支払い済み報酬';
	const WORD_00543 = '支払い済一覧';
	const WORD_00544 = '支払い済情報はありません。';
	const WORD_00545 = '処理日';
	const WORD_00546 = '支払金額';
	const WORD_00547 = '紹介者一覧';
	const WORD_00548 = '紹介者の情報はありません。';
	const WORD_00549 = '未確定';
	const WORD_00550 = '確定済';
	const WORD_00551 = '会員氏名';
	const WORD_00552 = '登録';
	const WORD_00553 = '登録日・購入日';
	const WORD_00554 = '報酬金額';
	const WORD_00555 = '報酬確定';
	const WORD_00556 = 'サービス名';
	const WORD_00557 = 'お問い合わせ';
	const WORD_00558 = 'お問い合わせの受付が完了いたしました';
	const WORD_00559 = '画面が更新されました。';
	const WORD_00560 = 'お問い合わせありがとうございます。';
	const WORD_00561 = '後日担当よりご連絡させていただきますのでしばらくお待ちください。';
	const WORD_00562 = '在庫がなくなりました。';
	const WORD_00563 = '現在入荷待ちとして購入が可能です。';
	const WORD_00564 = '過去に購入されたことがある商品です';
	const WORD_00565 = '在庫に余裕がございます。';
	const WORD_00566 = '残りあとわずかとなりました。';
	const WORD_00567 = '現在この商品は購入できません。';
	const WORD_00568 = '販売期間が終了いたしました。';
	const WORD_00569 = 'たくさんの購入ありがとうございました。';
	const WORD_00570 = '購入内容はマイページよりご確認ください。';
	const WORD_00571 = '購入には会員登録が必要です。';
	const WORD_00572 = '売切れになりました。';
	const WORD_00573 = 'たくさんの購入ありがとうございました。';
	const WORD_00574 = 'お問い合わせ';
	const WORD_00575 = '上記登録内容で問題ありませんか？';
	const WORD_00576 = '問題なければ下記「入力内容の確認」ボタンをクリックして進んでください。';
	const WORD_00577 = '問題なければ下記「登録を完了する」ボタンをクリックして完了してください。';
	const WORD_00578 = 'お問い合わせの受付が完了いたしました';
	const WORD_00579 = 'Web社内報編集部へのお問い合わせをありがとうございます。';
	const WORD_00580 = '順次対応してまいりますので、しばらくお待ちくださいませ。';
	const WORD_00581 = 'HOMEへ戻る';
	const WORD_00582 = '画面が更新されました。';
	const WORD_00583 = '掲示板';
	const WORD_00584 = 'コンテンツ記事はありません';
	const WORD_00585 = '社用IDでログインする';
	const WORD_00586 = '通知一覧';
	const WORD_00587 = 'パスワード変更';
	const WORD_00588 = '戻る';
	const WORD_00589 = 'ネイティブアプリで開く';
	const WORD_00590 = '配送希望日時があれば希望日時を入力してください';
	const WORD_00591 = '第1希望';
	const WORD_00592 = '第2希望';
	const WORD_00593 = '第3希望';
	const WORD_00594 = '希望有無';
	const WORD_00595 = '準備出来次第配送';
	const WORD_00596 = '希望日時を設定する';
	const WORD_00597 = 'その他注文に関する要望があれば入力してください';
	const WORD_00598 = '(現地決済(代引き等)を選択された方へ)';
	const WORD_00599 = '配送希望日時';
	const WORD_00600 = 'その他注文に関する要望';
	const WORD_00601 = '同意してログイン';
	const WORD_00602 = 'プライバシーポリシー';
	const WORD_00603 = '未読一覧';
	const WORD_00604 = 'ご利用の環境ではご利用いただけません。';
	const WORD_00605 = 'もっと見る';
	const WORD_00606 = 'PUSH通知を受け取らない設定にする';
	const WORD_00607 = '通知設定に失敗しました。ブラウザの通知設定を「確認」に戻して設定しなおして下さい。';
	const WORD_00608 = 'セッションが切断された可能性があります。ログインしなおして下さい。';
	const WORD_00609 = 'setリクエストエラー';
	const WORD_00610 = 'サーバーエラー';
	const WORD_00611 = '使用可能なインスタンスIDトークンはありません。 生成する許可を要求します。';
	const WORD_00612 = 'トークンの取得中にエラーが発生しました。';
	const WORD_00613 = 'ブラウザの設定で通知がブロックされています。設定を変更して下さい。';
	const WORD_00614 = 'PUSH通知を受け取る設定にする';
	const WORD_00615 = 'サービスワーカー登録成功';
	const WORD_00616 = 'トークンの更新が通知されました。';
	const WORD_00617 = '更新されたトークンの取得中にエラーが発生しました。';
	const WORD_00618 = 'PUSH通知を受け取らない設定にする';
	const WORD_00619 = '使用可能なインスタンスIDトークンはありません。生成する許可を要求します。';
	const WORD_00620 = '通知の受け取りを停止しますか？';
	const WORD_00621 = '通知を受け取りますか？';
	const WORD_00622 = '登録失敗';
	const WORD_00623 = 'Pushは利用できません。';
	const WORD_00624 = '通知は有効です';
	const WORD_00625 = '通知はブロック中です';
	const WORD_00626 = '通知は無効です';
	const WORD_00627 = '通知は利用きないブラウザです';
	const WORD_00628 = '通知は利用できません';
	const WORD_00629 = 'ファイル削除';
	const WORD_00630 = '編集が完了しました。';
	const WORD_00631 = '編集に失敗しました。';
	const WORD_00632 = 'ディレクトリ作成エラー';
	const WORD_00633 = '現在のパスワード';
	const WORD_00634 = '新しいパスワード';
	const WORD_00635 = '新しいパスワード（確認）';
	const WORD_00636 = 'パスワードが違います。';
	const WORD_00637 = '必須です';
	const WORD_00638 = 'パスワードが一致しません';
	const WORD_00639 = '操作が不正です。';
	const WORD_00640 = 'パスワードが変更されました。';
	const WORD_00641 = 'パスワードの変更に失敗しました。';
	const WORD_00642 = '入力内容に間違いがあります。';
	const WORD_00643 = '同意して社用IDでログイン';
	const WORD_00644 = 'お気に入りをする';
	const WORD_00645 = 'サイトご利用時にお読みください';
	const WORD_00646 = '仮パスワード';
	const WORD_00647 = '自動的に仮パスワードが発行されました。';
	const WORD_00648 = '新しいパスワードをご自身でマイページから変更してください。';
	const WORD_00649 = '全てのイベント・セミナー';
	const WORD_00650 = '一覧に戻る';
	const WORD_00651 = 'この商品へのレビュー';
	const WORD_00652 = 'レビューを入力してください';
	const WORD_00653 = 'レビューする';
	const WORD_00654 = 'レビューしない';/* JS用 */
	const WORD_00655 = 'レビューが入力されていません';
	const WORD_00656 = 'レビューするには会員登録が必要です';
	const WORD_00657 = 'レビュー投稿の最終確認';
	const WORD_00658 = 'レビューを投稿しても良いですか？';
	const WORD_00659 = 'レビュー編集の最終確認';
	const WORD_00660 = 'レビューを編集しても良いですか？';
	const WORD_00661 = 'レビュー削除の最終確認';
	const WORD_00662 = 'レビューを削除しても良いですか？';
	const WORD_00663 = '通報投稿の最終確認';
	const WORD_00664 = '通報を投稿しても良いですか？';
	const WORD_00665 = '返信レビュー投稿の最終確認';
	const WORD_00666 = '返信レビューを投稿しても良いですか？';
	const WORD_00667 = 'このレビューを削除しますか？';
	const WORD_00668 = '返信のレビューする';
	const WORD_00669 = '支払い方法を選択してください';
	const WORD_00670 = '本決済はSTRIPEを利用して決済しております。';
	const WORD_00671 = '本決済はROBOT PAYMENTを利用して決済しております。';
	const WORD_00672 = '本決済はUNIVA PAYCASTを利用して決済しております。';
	const WORD_00673 = '購入商品名';
	const WORD_00674 = '決済金額';
	const WORD_00675 = '購入内容';
	const WORD_00676 = '申込者情報';
	const WORD_00677 = '申込内容';
	const WORD_00678 = '申込みする方の情報を入力してください。';
	const WORD_00679 = '購入する方の情報を入力してください。';
	const WORD_00680 = '※サービス向上のため申込みが完了すると自動的に会員登録されますのでご了承ください。';
	const WORD_00681 = '※サービス向上のため購入が完了すると自動的に会員登録されますのでご了承ください。';
	const WORD_00682 = '本日は休業のため準備出来次第配送は選択できません。';
	const WORD_00683 = '営業開始後の希望日時を設定してください。';
	const WORD_00684 = '午前休業のため準備出来次第配送は選択できません。';
	const WORD_00685 = '受付時間内での希望日時を設定してください。';
	const WORD_00686 = '午後休業のため準備出来次第配送は選択できません。';
	const WORD_00687 = '受付時間内での希望日時を設定してください。';
	const WORD_00688 = '現在営業時間外のため準備出来次第配送は選択できません。';
	const WORD_00689 = '受付時間内での希望日時を設定してください。';
	const WORD_00690 = 'HOME';
	const WORD_00691 = 'イベント・セミナー';
	const WORD_00692 = '会員登録';
	const WORD_00693 = 'お気に入り';
	const WORD_00694 = '詳細を見る';
	const WORD_00695 = 'アクセス';
	const WORD_00696 = 'お気に入り一覧';
	const WORD_00697 = '初回登録日時';
	const WORD_00698 = 'ステータス';
	const WORD_00699 = '外部サービス連携';
	const WORD_00700 = 'サービス申込履歴';
	const WORD_00701 = '申込日';
	const WORD_00702 = '現在申込済みのサービスはありません。';
	const WORD_00703 = 'ファイル';
	const WORD_00704 = 'パスワードを変更する場合は下記の変更フォームからパスワードを変更してください';
	const WORD_00705 = '申込中のサービス';
	const WORD_00706 = '決済カードの変更';
	const WORD_00707 = '上記サービスの決済カードを変更しても問題ありませんか？';
	const WORD_00708 = '問題なければ下記「カードを変更する」ボタンをクリックしてください。';
	const WORD_00709 = 'カードを変更する';
	const WORD_00710 = 'ご利用カード';
	const WORD_00711 = '（下4桁）';
	const WORD_00712 = '登録なし';
	const WORD_00713 = 'カード変更を完了する';
	const WORD_00714 = 'セミナー名';
	const WORD_00715 = '閉じる';
	const WORD_00716 = '購入出来ない商品です。';
	const WORD_00717 = 'その他の申込可能なセミナー';
	const WORD_00718 = '通知はありません';
	const WORD_00719 = 'コンテンツいいね';
	const WORD_00720 = 'コンテンツコメント投稿';
	const WORD_00721 = '掲示板いいね';
	const WORD_00722 = '掲示板コメント投稿';
	const WORD_00723 = '投稿本文';
	const WORD_00724 = '商品いいね';
	const WORD_00725 = '商品レビュー投稿';
	const WORD_00726 = 'コンテンツお気に入り';
	const WORD_00727 = '商品お気に入り';
	const WORD_00728 = 'コンテンツコメント共感';
	const WORD_00729 = '商品レビュー共感';
	const WORD_00730 = '掲示板トピックス投稿';
	const WORD_00731 = 'コンテンツいいね・投稿履歴';
	const WORD_00732 = '商品いいね・投稿履歴';
	const WORD_00733 = '掲示板いいね・投稿履歴';
	const WORD_00734 = '掲示板トピックスいいね';
	const WORD_00735 = '掲示板コメント共感';
	const WORD_00736 = 'コンテンツのお気に入りはありません';
	const WORD_00737 = 'あなたがお気に入り登録したコンテンツ';
	const WORD_00738 = '追加されました';
	const WORD_00739 = '移動する';
	const WORD_00740 = 'あなたがいいねした商品';
	const WORD_00741 = 'あなたがいいねした商品はありません。';
	const WORD_00742 = 'あなたが投稿した商品レビュー';
	const WORD_00743 = 'あなたが投稿した商品レビューはありません。';
	const WORD_00744 = 'あなたが共感した商品レビュー';
	const WORD_00745 = 'あなたが共感した商品レビューはありません。';
	const WORD_00746 = '共感されました';
	const WORD_00747 = '投稿されました';
	const WORD_00748 = 'あなたがお気に入り登録した商品';
	const WORD_00749 = '商品のお気に入りはありません';
	const WORD_00750 = '元に戻す';
	const WORD_00751 = 'クレジット';



}
require_once dirname(__FILE__).'/../../language_unique/jp.php';

?>