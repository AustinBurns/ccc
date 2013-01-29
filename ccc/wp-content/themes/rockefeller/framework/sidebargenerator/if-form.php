<?php
function if_form_admin($optionstheme, $theslug) {
	if_saveform_admin($optionstheme, $theslug);
	
	$themename = THE_THEMENAME;
	$shortname = THE_SHORTNAME;
	
	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '. __('settings saved.', THE_LANG) .'</strong></p></div>';
	    
?>
	<style type="text/css">
	#optionsframework{
		max-width: 780px;
	}
	#optionsframework-submit {
		padding: 7px 10px;
		border-top: 1px solid #ECECEC;
		background-color: #F1F1F1;
		background-image: -moz-linear-gradient(center top , #F9F9F9, #ECECEC);
	}
	#optionsframework .button-primary {
		float:right;
	}
	table {width:100%;}
	table, td {font-size:13px; border:0px; }
	th {font-weight:normal; width:250px; border:0px;}
	.rowfield{padding:10px;}
	span.setting-description { font-size:11px; line-height:16px; font-style:italic;}
	.imguploader{
		position:relative;
		float:left;
	}
	.imguploader img{
		padding:3px;
		border:1px solid #f5f5f5;
	}
	a.delimguploader{
		background-image:url(<?php echo THE_FRAMEWORKURI;  ?>admin/images/ico-delete.png);
		background-repeat:no-repeat;
		position:absolute;
		bottom:-2px;
		right:-2px;
		width:16px;
		height:16px;
		display:none;
		z-index:7;
		cursor:pointer;
	}
	.tab_container .of-radio-img-img {
		border:3px solid #f9f9f9;
		margin:0 5px 10px 0;
		display:block;
		cursor:pointer;
		float:left;
	}
	.tab_container .of-radio-img-radio{
		display:none;
	}
	.tab_container .of-radio-img-label{
		display:none;
	}
	.tab_container .of-radio-img-selected {
		border:3px solid #ccc
	}
	.tab_container .of-radio-img-img:hover {
		opacity:.8;
	}
	/************For Text Array Type********/
	div.delcage{
		margin-top:8px;
		width:100%;
	}
	a.delbutton{
		display:block;
		background-image:url(<?php echo THE_FRAMEWORKURI;  ?>admin/images/delbutton.gif);
		background-repeat:no-repeat;
		background-position:right;
		padding:4px 22px 4px 4px;
		background-color:#ffffff;
		border-top:1px solid #f7f7f7;
		border-left:1px solid #f7f7f7;
		border-right:1px solid #f0f0f0;
		border-bottom:1px solid #f0f0f0;
		float:left;
		text-decoration:none;
		margin-right:8px;
		margin-bottom:5px;
	}
	a.delbutton:hover{
		background-color:#fafafa;
	}
	/************End For Text Array Type********/
	</style>
	
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo THE_FRAMEWORKURI; ?>admin/css/colorpicker.css" />
	<script type="text/javascript" src="<?php echo THE_FRAMEWORKURI;  ?>admin/js/colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo THE_FRAMEWORKURI;  ?>admin/js/eye.js"></script>
	<script type="text/javascript" src="<?php echo THE_FRAMEWORKURI; ?>admin/js/utils.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo THE_FRAMEWORKURI;  ?>admin/css/tabs.css" />
	<!-- Javascript for the tabs -->
	<script type="text/javascript">
	jQuery(document).ready(function(){
			
			/* For Tab */
			jQuery(".tab_content").hide(); //Hide all content
			jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
			jQuery(".tab_content:first").show(); //Show first tab content
			//On Click Event
			jQuery("ul.tabs li").click(function() {
				jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
				jQuery(this).addClass("active"); //Add "active" class to selected tab
				jQuery(".tab_content").hide(); //Hide all tab content
				var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				jQuery(activeTab).fadeIn(900); //Fade in the active content
				return false;
			});
			
			/************For Text Array Type********/
			<?php 
			foreach ($optionstheme as $value) {
				if ($value['type'] == "textarray") { 
			?>
			jQuery("input#buttonarray<?php echo $value['id']; ?>").click(function(evt){
				
				evt.preventDefault();
				
				<?php 
					$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
				?>
				var textarrayname = jQuery('input#<?php echo $value['id']; ?>').val();
				var textarrayid = jQuery.trim(textarrayname).toLowerCase().replace(" ","-");
				if(textarrayid!=""){
					jQuery.ajax({
						type : "POST",
						url : '<?php echo $url; ?>',
						data : "action=savearray&textarrayid=<?php echo $value['id']; ?>&arrayid="+textarrayid+"&<?php echo $value['id']; ?>="+textarrayname,
						success : function(data){
							var arraycage = 'div#<?php echo $value['id']."-cage"; ?>';
							var anchorarray = '<a href="'+textarrayid+'" rel="<?php echo $value['id']; ?>" id="'+textarrayid+'" class="delbutton">'+textarrayname+'</a>';
							jQuery(arraycage).append(anchorarray);
							jQuery(arraycage + ' a.delbutton').click(delbuttononclick);
							jQuery('input#<?php echo $value['id']; ?>').val('');
						}
					});
				}else{
					alert('<?php _e('Please input the textbox first!',THE_LANG); ?>');
				}
			});
			
			<?php 
				}//end if
			} //end foreach
			?>
			jQuery("a.delbutton").click(delbuttononclick);
			
			function delbuttononclick(evt){
				evt.preventDefault();
				<?php 
					$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
				?>
				if(confirm('<?php _e('Are you sure you want to delete this item?',THE_LANG); ?>')){
					var arrayid = jQuery(this).attr("href");
					var textarrayid = jQuery(this).attr("rel");
					var thedelbutton = jQuery(this);
					jQuery.ajax({
						type : "POST",
						url : '<?php echo $url; ?>',
						data : "action=deltextarray&arrayid="+arrayid+"&textarrayid="+textarrayid,
						success : function(data){
							thedelbutton.fadeOut("slow",function(){
								thedelbutton.remove();
							});
						}
					});
				}
			};
			/************End For Text Array Type********/
	});	
	
	</script>
	<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2 class="nav-tab-wrapper">
		<?php 
			foreach ($optionstheme as $value) {
				if ($value['type'] == "open") { 
					$valueopenname = strtolower(str_replace(" ","-",$value['name']));
					echo '<a id="of-option-'. $valueopenname .'-tab" class="nav-tab nav-tab-active" title="'. $value['name'] .'" href="#of-option-'. $valueopenname .'">';
					echo $value['name'];
					echo '</a>';
				}
			}
		?>
    </h2>
	<div class="bordertitle"></div>
		<div class="metabox-holder">
        	<div id="optionsframework" class="postbox">
		<form method="post">
		<div class="tab_container">
		<?php 
			foreach ($optionstheme as $value) {
			if ($value['type'] == "open") { 
				$valueopenname = strtolower(str_replace(" ","-",$value['name']));
		?>
		 
		 <div id="<?php echo $valueopenname; ?>" class="tab_content" >
		<table  border="0" cellpadding="0" cellspacing="0" style="text-align:left" >
		<?php
				}
				if ($value['type'] == "close") { 
		?>
		</table></div>
		<?php
				}
				if ($value['type'] == "heading") { 
		?>
		<thead>
		<tr>
        	<td colspan="2"><h3><?php _e('Sidebar', THE_LANG); ?></h3><span class="setting-description"><?php _e('', THE_LANG); ?></span></td>
        </tr>
		</thead>
		<?php
				}
				if ($value['type'] == "textarray") { 
		?>
		<tr valign="top"> 
		    <th scope="row" class="rowfield"><?php _e('Sidebar Generator', THE_LANG); ?>:</th>
		    <td class="rowfield">
		        <input name="<?php echo $value['id']; ?>" size="60" id="<?php echo $value['id']; ?>" type="text" value="" /> 
                <input name="buttonarray<?php echo $value['id']; ?>" id="buttonarray<?php echo $value['id']; ?>" type="button" class="button-primary" value="<?php _e("Add", THE_LANG); ?>" /><br />
                <span class="setting-description"><?php _e('Please enter name of new sidebar', THE_LANG); ?></span><br />
 				<div id="<?php echo $value['id']; ?>-cage" class="delcage">
               	<?php 
					$textarrayval = get_option($value['id']);
					if(is_array($textarrayval)){
						foreach($textarrayval as $ids => $val){
							echo '<a href="'.$ids.'" rel="'.$value['id'].'" id="'.$ids.'" class="delbutton">'.$val.'</a>';
						}
					}
				?>
                <div class="clear"></div>
                </div>
		    </td>
		</tr>
		<?php
				}
			}
		?>
		</table>
	</div>
	
	<div id="optionsframework-submit">
    <input name="reset" type="submit" class="button-secondary"  value="<?php _e('Restore Defaults', THE_LANG); ?>" onclick="return confirm('<?php _e('Click OK to reset. Any theme settings will be lost!', THE_LANG)?>');"/>
	<input name="save" type="submit" class="button-primary" value="<?php _e('Save Changes', THE_LANG); ?>" /> 
	<input type="hidden" id="action" name="action" value="save" />
	</div>
	</form>
    </div>
    </div>
	
<?php
}// end if_form_admin

function if_saveform_admin($optionstheme, $theslug){
	
	$themename = THE_THEMENAME;
	$shortname = THE_SHORTNAME;

	$getpage = (isset($_GET['page']))? $_GET['page'] : "";
	if ( $getpage == $theslug ) {
	  if (isset($_REQUEST['reset']) ) {
		  foreach ($optionstheme as $value) {
			update_option( $value['id'],  $value['std'] ); }
		  foreach ($optionstheme as $value) {
			if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $value['std'] ); } else { delete_option( $value['id'] ); } }
		  header("Location: themes.php?page=".$theslug."&saved=true");
		  die;
	  }
	  
	  /******** For Textarray Type **********/
	  if(isset($_REQUEST['action']) && $_REQUEST['action'] == "deltextarray"){
		if(isset($_REQUEST['textarrayid'])){
			$valueid = $_REQUEST['textarrayid'];
			$textarrayval = get_option($valueid);
			if(isset($_REQUEST['arrayid'])){
				unset($textarrayval[$_REQUEST['arrayid']]);
				update_option($valueid, $textarrayval);
			}
		}
		
	  }
	  if(isset($_REQUEST['action']) && $_REQUEST['action'] == "savearray"){
		if(isset($_REQUEST['textarrayid'])){
			$valueid = $_REQUEST['textarrayid'];
			$textarrayval = get_option($valueid);
			if(isset($_REQUEST['arrayid'])){
				$textarrayid = $_REQUEST['arrayid'];
				if($textarrayid!=""){
					if(is_array($textarrayval)){
						$textarrayval[$textarrayid] = $_REQUEST[$valueid];
					}else{
						$textarrayval = array($textarrayid => $_REQUEST[$valueid]);
					}
				}
				update_option($valueid, $textarrayval);
			}
		}
		
	  }
	  /******** End of Textarray Type **********/
	  if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) { 
		  foreach ($optionstheme as $value) {
			if($value["type"]=="textarray"){
				$textarrayval = get_option($value['id']);
				if(isset( $_REQUEST[ $value['id'] ] )){
					$textarrayid = str_replace(" ","-",trim(strtolower($_REQUEST[$value['id']])));
					if($textarrayid!=""){
						if(is_array($textarrayval)){
							$textarrayval[$textarrayid] = $_REQUEST[$value['id']];
						}else{
							$textarrayval = array($textarrayid => $_REQUEST[$value['id']]);
						}
					}
					update_option($value['id'], $textarrayval);
				}
			}else{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
				
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} else { 
					delete_option( $value['id'] ); 
				} 
			}
		  }
		  echo '<meta http-equiv="refresh" content="0;url=themes.php?page=' .$theslug. '&saved=true" />';
		  die;
		}
	}
}
?>