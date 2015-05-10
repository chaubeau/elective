<!DOCTYPE HTML> 
<html> 
<head> 
<title>HTML5+CSS3实现图片旋转</title> 
<script type="text/javascript">  
function startup() {  
var canvas = document.getElementById('canvas');  
var ctx = canvas.getContext('2d');  
var img = new Image(); 
img.src = 'http://statics.juxia.com/uploadfile/content/2014/10/2014101512115155.gif'; 
img.onload = function() { 
while ( 1 < 1){
ctx.translate(img.width / 2, img.height / 2);  
ctx.rotate(30 * Math.PI / 120);  
// 120为设置旋转角度 
ctx.drawImage(img, 0, 0, 165, 60); // 165和60分别是图片宽度高度 

}  
}  
</script> 
</head> 
<body onload='startup();'> 
<div id="pw_body" style="width:100%;height:100%"> 
<canvas id="canvas" style="position: absolute; left: 300px; top: 100px;" width="800" height="600"></canvas> 
</div> 
<p>代码整理于网络</p> 
</body> 
</html> 
