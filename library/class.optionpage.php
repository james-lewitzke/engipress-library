<?php
class eng_optionpage {
	public $title;
	public $titleprint;
	public $slug;
	public $activestatus;
	public $html = array();
	
	public function startpage() {
		add_action( 'admin_menu', array($this, 'eng_add_page') );
		add_action('admin_init', array($this, 'eng_settings') );
	}
	
	public function eng_add_page() {
		if ($this->slug == ENGTHEMESLUG . 'options') :
			add_menu_page('Engipress Library Plugin Options', 'Engipress Library Options', 'manage_options', ENGTHEMESLUG . 'options', array( $this, 'eng_do_overpage' ) );
			add_submenu_page(ENGTHEMESLUG . 'options', 'Engipress Library Plugin Options', '', 'manage_options', ENGTHEMESLUG . 'options', array( $this, 'eng_do_overpage' ));
		
		else :
			add_submenu_page(ENGTHEMESLUG . 'options', $this->title, $this->title, 'manage_options', ENGTHEMESLUG . $this->slug . '_options', array( $this, 'eng_do_page' ) );
			
		endif;
	}
	
	public function eng_settings() {
		register_setting( $this->slug, ENGTHEMESLUG . $this->slug . '_options');
		add_settings_section('eng_section', '', array(&$this, 'eng_do_titleprint'),  ENGTHEMESLUG . $this->slug . '_options', ENGTHEMESLUG . $this->slug . '_options' );
	
		foreach ($this->html as $key => $html) :
			add_settings_field( $key, $html['title'], array($this, 'eng_do_htmlprint' ), ENGTHEMESLUG . $this->slug . '_options', 'eng_section', $key );
		endforeach;
	}

public function eng_do_htmlprint($key) {
	$html = $this->html[$key];
	$options = get_option(ENGTHEMESLUG . $this->slug . '_options');
	$id = ENGTHEMESLUG . $this->slug . '_options[' . $html['result'] . ']';
	$title = ENGTHEMESLUG . $this->slug . '_options';
	$tagtype = $html['tagtype'];
	$choices = $html['choices'];
	$name = $html['name'];
	$class= $html['class'];
	$description = $html['description'];
	$size = $html['size'];
	$cols = $html['cols'];
	$rows = $html['rows'];

if ($tagtype != 'inputcheck') :
echo '<div><span class="description">' . $description . '</span></div>';
endif;

switch ($tagtype) :
case "inputcheck" :
?>
<input
style="width: auto"
type="checkbox"
id="<?php echo $id ?>" 
name="<?php echo $id ?>" 
class="<?php echo $class ?>" 
value="<?php echo $description ?>" 
<?php echo checked( $options[$html['result']], $description, false ); ?>
/> 

<label for="<?php echo $id ?>"><?php echo '<span class="description">' . $description . '</span>' ?></label>
<?php
break;

case "textarea" :
?>
<textarea
id="<?php echo $id ?>" 
class="<?php echo $class ?>" 
name="<?php echo $id ?>"
cols="<?php echo $cols ?>"
rows="<?php echo $rows ?>"
style="width: auto">
<?php echo $options[$html['result']]?>
</textarea> 
<?php
break;

case "inputtext" :
?>
<input
type="text"
id="<?php echo $id ?>" 
class="<?php echo $class ?>" 
name="<?php echo $id ?>"
value="<?php echo $options[$html['result']]?>"
size="<?php echo $size ?>"
style="width: auto"
/>
<?php
break;

case "inputcolor" :
?>
<script type="text/javascript">
$ = jQuery;
$(document).ready(function() {
$('#<?php echo $title ?>\\[<?php echo $html['result'] ?>\\]').ColorPicker({
color: '#0000ff',
onSubmit: function(hsb, hex, rgb, el) {
$(el).val(hex);
$(el).ColorPickerHide();
},
onBeforeShow: function () {
$(this).ColorPickerSetColor(this.value);
}
})
.bind('keyup', function(){
$(this).ColorPickerSetColor(this.value);
});
});
</script>
<input
id="<?php echo $id ?>" 
name="<?php echo $id ?>" 
type="text" 
value="<?php echo $options[$html['result']] ?>" 
/>
<?php
break;

case "inputradio" :
foreach ( $choices as $rkey => $radiobutton) :
$radiosetting = $options[$name];

if ( '' != $radiosetting ) :
if ($options[$name] == $radiobutton['value']) :
	$checked = 'checked="checked"';

else :
	$checked = '';
	
endif;

endif;

?>
<div style="display: block">
<input
type="radio"
name="<?php echo $title . '[' . $name . ']'?>" 
value="<?php echo $radiobutton['value'] ?>"
<?php echo $checked; ?>
/> 
<span style="padding-right: 15px"><?php echo $radiobutton['label']; ?></span>
</div>
<?php
endforeach;
break;

endswitch;
}
	
	public function eng_do_page() {
		if ( ! isset( $_GET['updated'] ) )
		$_GET['updated'] = false;
		?>
		<?php if ( false !== $_GET['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
		
		<div class="wrap">
			<form method="post" action="options.php">

				<?php settings_fields($this->slug); ?>
				<?php do_settings_sections(ENGTHEMESLUG . $this->slug . '_options'); ?>

				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
				</p>
				
				<div style="display: none;" id="ENGTHEMESLUG">
					<?php echo ENGTHEMESLUG; ?>
				</div>
				
				<div style="display: none;" id="$theme_data['Name']">
					<?php echo $theme_data['Name']; ?>
				</div>

			</form>
		</div>
		<?php
	}

	public function eng_do_titleprint() {
		$this->eng_do_icon(); echo "<h2>" . wp_get_theme() . $this->titleprint . "</h2>";
	}
	
	public function eng_do_icon() {
		echo '<img src="';
		echo eng_url();
		echo '/wp-admin/images/generic.png" height="36" width="36" style="float: left; padding-top: 15px; padding-right: 10px;" />';
	}
	
	public function eng_do_overpage() {
		?>
		<div class="wrap">
			<?php $this->eng_do_titleprint(); ?>
			
			<h4>Thank You for using the Engipress Library Plugin</h4>
		</div>
		<?php
	}
}
?>