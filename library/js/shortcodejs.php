<?php
include '../vars.shortcodes.php';
global $shortcode_editor_row;
header('Content-type: text/javascript');
?>
(function() {
    tinymce.create('tinymce.plugins.URL', {
        init : function(ed, url) {
<?php
foreach ($shortcode_editor_row as $button => $buttonitem) : 
$last_button = end(array_keys($shortcode_editor_row));
?>
		ed.addButton('<?php echo $buttonitem['name']; ?>', {
			title : '<?php echo $buttonitem['title']; ?>',  
			image : <?php echo ENGPLUGINPATH . '/library/images/editor/' . $buttonitem['image']; ?>',  
			onclick : function() {
			<?php switch ($buttonitem['tagtype']) : 
			case 'self-closing' : ?>
			ed.selection.setContent('[<?php echo $buttonitem['name']; ?>]');
			<?php break; ?>
			<?php case 'open-ended' : ?>
		ed.selection.setContent('[<?php echo $buttonitem['name']; ?>]' + ed.selection.getContent() + '[/<?php echo $buttonitem['name']; ?>]');
			<?php break; ?>
			<?php endswitch; ?>
		}
<?php if ($button == $last_button) : ?>
	});
<?php else : ?>
	}),
<?php endif; ?>
<?php endforeach; ?>
        },
        createControl : function(n, cm) {
            return null;  
        },  
    });
    tinymce.PluginManager.add('URL', tinymce.plugins.URL);  
})();