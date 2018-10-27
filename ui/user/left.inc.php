<?php 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="images/style_admin.css" />
	<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
</head>
<body>
	<div id="Accordion1" class="Accordion">
		<?php foreach($menu_type as $menutype=>$menuname){ ?>
			<div class="AccordionPanel">
				<div class="AccordionPanelTab"><?php =$menuname ?></div>
				<div class="AccordionPanelContent">
					<?php foreach($menu_item[$menutype] as $itemkey=>$itemname){ ?>
					<?php //echo $menu_href[$menutype."-".$itemkey]; ?>
					<div class="left_menu">
						<a href="<?php =$menu_href[$menutype."-".$itemkey] ?>" title="<?php =$menu_title[$menutype."-".$itemkey] ?>" target="main">
							<span style="float:left;"><img src="<?php =$menu_src[$menutype."-".$itemkey] ?>" border="0" /></span>
							<span style="float:left; margin-left:5px; margin-top:8px;"><?php =$itemname ?></span>
						</a>
		    		</div>
	    			<?php } ?>
		    	</div>
			</div>
		<?php } ?>
	</div>
	<div style="height:20px; margin-top:10px;"><span style="margin-left:35px; font-size:11px;">程序版本：v<?php =$version ?></span></div>
	<script type="text/javascript">
		var Accordion1 = new Spry.Widget.Accordion("Accordion1");
	</script>
</body>
</html>
