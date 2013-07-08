<?php
// 出力する画像サイズの指定
$width = 150;
$height = 50;

// サイズを指定して、背景用画像を生成
$canvas = imagecreatetruecolor($width, $height);

// コピー元画像の指定
$targetImage = "./files/IMG_4088.JPG";
// ファイル名から、画像インスタンスを生成
$image = imagecreatefromjpeg($targetImage);
// コピー元画像のファイルサイズを取得
list($image_w, $image_h) = getimagesize($targetImage);

// 背景画像に、画像をコピーする
imagecopyresampled($canvas,  // 背景画像
                   $image,   // コピー元画像
                   0,        // 背景画像の x 座標
                   0,        // 背景画像の y 座標
                   0,        // コピー元の x 座標
                   0,        // コピー元の y 座標
                   $width,   // 背景画像の幅
                   $height,  // 背景画像の高さ
                   $image_w, // コピー元画像ファイルの幅
                   $image_h  // コピー元画像ファイルの高さ
                  );

// 画像を出力する
imagejpeg($canvas,           // 背景画像
          "./files/output.jpg",    // 出力するファイル名（省略すると画面に表示する）
          100                // 画像精度（この例だと100%で作成）
         );

// メモリを開放する
imagedestroy($canvas);

?>