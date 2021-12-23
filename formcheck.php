<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォームのチェック</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<div>
	
  <?php
  require_once("lib/util.php");
  // 文字エンコードの検証
  if (!cken($_POST)){
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding ;
    // エラーメッセージを出して、以下のコードをすべてキャンセルする
    exit($err);
  }
  // HTMLエスケープ（XSS対策）
  $_POST = es($_POST);
  ?>
				
  <?php
  // エラーを入れる配列
  $errors = [];
	
// POSTされたテキスト文を取り出す
  if (isset($_POST["yourname"])){
     $yourname = $_POST["yourname"];
     // HTMLタグやPHPタグを削除する
     $yourname = strip_tags($yourname);
     // 最大150文字だけ取り出す（改行コードもカウントする）
     $yourname= mb_substr($yourname, 0, 150);
     // HTMLエスケープを行う
     $yourname = es($yourname);
	  
	  if($yourname===""){
		$errors[] = "「お名前（漢字）」が入力されていません。";
	  }
    } else {
    // POSTされた値がないとき
    $errors[] = "「お名前（漢字）」に入力エラーがありました。";
    }
	
if (isset($_POST["yourname2"])){
    $yourname2 = $_POST["yourname2"];
    // HTMLタグやPHPタグを削除する
    $yourname2 = strip_tags($yourname2);
    // 最大150文字だけ取り出す（改行コードもカウントする）
    $yourname2= mb_substr($yourname2, 0, 150);
    // HTMLエスケープを行う
    $yourname2 = es($yourname2);
	
	 if($yourname2===""){
		 $errors[] = "「お名前（カナ）」が入力されていません。";
	 }
	  
   } else {
     // POSTされた値がないとき
    $errors[] = "「お名前（カナ）」に入力エラーがありました。";
   }
				
  if (isset($_POST["mail"])){
    $mail = $_POST["mail"];
    // HTMLタグやPHPタグを削除する
    $mail = strip_tags($mail);
    // 最大150文字だけ取り出す（改行コードもカウントする）
    $mail= mb_substr($mail, 0, 150);
    // HTMLエスケープを行う
    $mail = es($mail);
	  
	  if($mail===""){
		 $errors[] = "「メールアドレス」が入力されていません。";
	 }
	  
   } else {
    // POSTされた値がないとき
    $errors[] = "「メールアドレス」に入力エラーがありました。";
   }
				
  if (isset($_POST["company"])){
    $company = $_POST["company"];
    // HTMLタグやPHPタグを削除する
    $company= strip_tags($company);
    // 最大150文字だけ取り出す（改行コードもカウントする）
    $company= mb_substr($company, 0, 150);
    // HTMLエスケープを行う
    $company = es($company);
   } else {
    // POSTされた値がないとき
     $errors[] = "「会社名」に入力エラーがありました。";
			}
			
  if (isset($_POST['comment'])){
    $comment = $_POST['comment'];
    // HTMLタグやPHPタグを削除する
    $comment = strip_tags($comment);
    // 最大150文字だけ取り出す（改行コードもカウントする）
    $comment= mb_substr($comment, 0, 150);
    // HTMLエスケープを行う
    $comment = es($comment);
	  
	  if($comment===""){
		 $errors[] = "「お問い合わせ内容」が入力されていません。";
	 }
	  
   } else {
     // POSTされた値がないとき
    $errors[] = "「お問い合わせ内容」に入力エラーがありました。";
   }
 ?>
  
 <?php
		
     $length = mb_strlen($yourname);
     if ($length>0) {
       $yourname_br = nl2br($yourname, false);
       echo "☆お名前：", $yourname_br;
      }
		
      echo "<br>";
				
      $length = mb_strlen($yourname2);
      if ($length>0) {
        $yourname2_br = nl2br($yourname2, false);
        echo "☆ふりがな：", $yourname2_br;
      }
		
      echo "<br>"; 
		
      $length = mb_strlen($mail);
      if ($length>0) {
         $mail_br = nl2br($mail, false);
         echo "☆メールアドレス：", $mail_br;
      }
		
      echo "<br>";
		
	  $length= mb_strlen($company);
      if ($length>0) {
        $company_br = nl2br($company, false);
        echo "☆会社名：", $company_br;
       }
		
	   echo "<br>";
		
	  $length = mb_strlen($comment);
      if ($length>0) {
        $comment_br = nl2br($comment, false);
        echo "☆ご意見：", $comment_br;
       } 
  ?>
		
  <?php
	if (count($errors)>0){
		
	echo "<HR>";
					 
	echo '<span class=="error">', implode("<br>", $errors), '</span>';
	
	}
  ?>
	
  <form method="post" action="contact.php">
	  <ul>
		  <li><input type="submit" value="戻る"></li>
	  </ul>
  </form> 
  
</div>
</body>
</html>
