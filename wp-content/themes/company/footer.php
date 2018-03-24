<?php
$theme_mods = company_get_theme_mods();
if($theme_mods["company_scroll_to_top"] == true){
	?>
	<a href="#" id="back-to-top-button"></a>
	<?php
}
?>
<footer id="colophon" class="full-width site-footer" role="contentinfo">
	<div class="footer-public">
		<?php company_footer_social(); ?>
		<?php company_footer_widgets(); ?>
	</div>
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</div>
<div class="clear"></div>
</body>
</html>