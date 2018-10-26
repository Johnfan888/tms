scrollpic.js   ----- 图片滚动JS代码

<!--滚动-->
    <div id="center1">
     <!--滚动-->
    <?
    while($rowimg1 = mysqli_fetch_array($result))
	{
	?>
    <div id="centerimg"><a href="example.php" target="_blank"><img src="<?=BYART_URL.$rowimg1["img_url"]?>" width="250" height="164" alt="<?=$rowimg1["img_title"]?>" border="0" /></a></div>
    <?
    }
	?>
    <!----->
     <!--滚动-->
    </div>
    <!--滚动-->
    <div id="center2"></div> 
	<script language="javascript" src="js/scrollpic.js"></script>
    </div>
	     <!--滚动完-->