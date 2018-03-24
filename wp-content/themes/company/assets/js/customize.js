( function( $ ) {
	var api = wp.customize;
	api.controlConstructor.layout_selection = api.Control.extend({
		ready: function() {
			var control  = this,
			_select  = this.container.find('.customizer_layout_select_list li');
			_select.on("click",function(){
				jQuery(this).parent().find("li.active").removeClass("active")
				jQuery(this).addClass("active");
				control.setting.set(jQuery(this).data("sidebar_layout"));
				api.previewer.refresh();
			});
		}
	});
	api.controlConstructor.google_fonts_select = api.Control.extend({
		ready: function() {
			var control  = this;
			var _select  = this.container.find('.customize_google_fonts_select');
			_select.on("change",function(){
				var font = jQuery(this).find("option:selected").val();
				jQuery(this).css({fontFamily:font});
				control.setting.set(font);
				api.previewer.refresh();
			});
		}
	});
	api.controlConstructor.footer_layout_selection = api.Control.extend({
		ready: function() {
			var control  = this,
			_select  = this.container.find('.customizer_footer_layout_select_list li');
			_select.on("click",function(){
				jQuery(this).parent().find("li.active").removeClass("active")
				jQuery(this).addClass("active");
				control.setting.set(jQuery(this).data("val"));
			});
		}
	});
} )( jQuery );
