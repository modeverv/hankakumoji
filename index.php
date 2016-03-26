<?php
$count = isset($_REQUEST["count"]) ? $_REQUEST["count"] : 0;
$kind = isset($_REQUEST["kind"]) ? $_REQUEST["kind"] : "a";
$buf = "";
$moji_a = array("1","2","3","4","5","6","7","8","9","0");
$moji_b = array("ｱ","ｲ","ｳ","ｴ","ｵ","ｶ","ｷ","ｸ","ｹ","ｺ");
$moji_c = array("a","b","c","d","e","f","g","h","i","j");

switch($kind){
case "a":
    $moji = $moji_a;
    break;
case "b":
    $moji = $moji_b;
    break;
case "c":
    $moji = $moji_c;
    break;
case "email":
    $moji = $moji_c;
    break;
case "url":
    $moji = $moji_c;
    break;
default:
    $moji = $moji_a;
    break;
}

$c = 0;

function getNext(){
    global $c,$moji;
    $m =  $moji[$c];
    $c = ($c + 1) % 10;
    return $m;
}

for($i=0;$i<$count;$i++){
    $buf .= getNext();
}

if($kind == "email"){
    $buf = preg_replace("/.{11}$/","@examle.com",$buf);
}
if($kind == "url"){
    $buf = preg_replace("/^.{7}/","http://",$buf);
    $buf = preg_replace("/.{15}$/",".com/index.html",$buf);    
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>半角文字列生成サービス</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
* { word-break:break-all; }
</style>
</head>
    <body>
    <h1>半角文字列生成サービス</h1>
    <form method="post">
      <div>
        <label for="count">生成したい文字数
          <input type="text" value="<?php echo $count ?>" name="count"/>
        </label>
      </div>
      <div style="margin-bottom:10px;">
        <p>出力種別</p>
         <label><input type="radio" name="kind" value="a" <?php echo $kind == "a" ? "checked" : ""; ?>/>数字</label>
         <label><input type="radio" name="kind" value="b" <?php echo $kind == "b" ? "checked" : ""; ?>/>半角カナ</label>
         <label><input type="radio" name="kind" value="c" <?php echo $kind == "c" ? "checked" : ""; ?>/>英数</label>
         <label><input type="radio" name="kind" value="email" <?php echo $kind == "email" ? "checked" : ""; ?>/>Email</label>
         <label><input type="radio" name="kind" value="url" <?php echo $kind == "url" ? "checked" : ""; ?>/>URL</label>         
      </div>
      <div>    
        <input type="submit" value="生成する">
      </div>
    </form>
    <h2>結果</h2>
    <div style="width:100%;">
      <?php echo $buf ?>
    </div>
    </body>
</html>