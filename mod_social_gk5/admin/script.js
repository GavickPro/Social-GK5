/*
 *
 * Main Social GK5 back-end script
 *
 */

// DOMContentLoaded event
jQuery(document).ready(function() {
	// initialize the configuration manager
	var configManager = new SocialGK5ConfigManager();
	
	// check Joomla! version and add suffix
	if(parseFloat((jQuery('#gk_about_us').data('jversion')).substr(0,3)) >= '3.2') {
		jQuery('#module-form').addClass('j32');
	}
	
	// initialize the main class
	var settings = new SocialGK5Settings();
	jQuery('.input-pixels').each(function(i, el){el = jQuery(el); el.parent().html("<div class=\"input-prepend\">" + el.parent().html() + "<span class=\"add-on\">px</span></div>");});
	jQuery('.input-ms').each(function(i, el){el = jQuery(el); el.parent().html("<div class=\"input-prepend\">" + el.parent().html() + "<span class=\"add-on\">ms</span></div>");});
	jQuery('.input-percents').each(function(i, el){el = jQuery(el); el.parent().html("<div class=\"input-prepend\">" + el.parent().html() + "<span class=\"add-on\">%</span></div>");});
	jQuery('.input-minutes').each(function(i, el){el = jQuery(el); el.parent().html("<div class=\"input-prepend\">" + el.parent().html() + "<span class=\"add-on\">minutes</span></div>");});
	jQuery('.input-gplus').each(function(i, el){el = jQuery(el); el.parent().html("<div class=\"input-prepend\"><span class=\"add-on\">http://plus.google.com/</span>" + el.parent().html() + "</div>");});
	jQuery('#config_manager_form').parent().css('margin-left', '0px');
});

/*
 *
 * Main class
 *
 */
function SocialGK5Settings() {
 	this.init();
}

SocialGK5Settings.prototype.init = function() {
	// binding
	var $this = this;
	// columns/rows view
	var merge = jQuery('#jform_params_twitter_columns-lbl').parent();
	var rows = jQuery('#jform_params_twitter_rows-lbl').parent();
	var columns = merge.html();
	merge.css('display', 'none');
	rows.html(rows.html() + columns);
	merge.remove();
	
	// current mode
	var sourceMode = jQuery('#jform_params_module_data_source').val();
	if(sourceMode == 'fb') {
		jQuery('#jform_params_module_data_source').attr('class', '');
		jQuery('#jform_params_module_data_source').addClass('fb');
		jQuery('#myTabTabs li a').each(function(index, item){
			item = jQuery(item);
			if(item.html().indexOf('Twitter') >= 0 || item.html().indexOf('Google') >= 0){
				item.parent().addClass('hidden');
			} else {
				item.parent().removeClass('hidden');
			}
		});
	} else if (sourceMode == 'gplus') {
		jQuery('#jform_params_module_data_source').attr('class', '');
		jQuery('#jform_params_module_data_source').attr('gplus', '');
		jQuery('#myTabTabs li a').each(function(index, item){
			item = jQuery(item);
			if(item.html().indexOf('Facebook') >= 0 || item.html().indexOf('Twitter') >= 0){
				item.parent().addClass('hidden');
			} else {
				item.parent().removeClass('hidden');
			}
		});
	} else {
		jQuery('#jform_params_module_data_source').attr('class', '');
		jQuery('#jform_params_module_data_source').addClass('twitter');
		jQuery('#myTabTabs li a').each(function(index, item){
			if(item.html().indexOf('Facebook') >= 0 || item.html().indexOf('Google') >= 0){
				item.parent().addClass('hidden');
			} else {
				item.parent().removeClass('hidden');
			}
		});
	}
	
	// hide one of unnecessary tabs
	jQuery('#jform_params_module_data_source').on('change blur', function() {
		var sourceMode = jQuery('#jform_params_module_data_source').val();
		console.log(sourceMode);
		if(sourceMode == 'fb') {
			jQuery('#jform_params_module_data_source').attr('class', '');
			jQuery('#jform_params_module_data_source').addClass('fb');
			jQuery('#myTabTabs li a').each(function(index, item){
				item = jQuery(item);
				console.log(item.html().indexOf('Twitter'));
				if(item.html().indexOf('Twitter') >= 0 || item.html().indexOf('Google') >= 0){
					item.parent().addClass('hidden');
				} else {
					item.parent().removeClass('hidden');
				}
			});
		} else if (sourceMode == 'gplus') {
			jQuery('#jform_params_module_data_source').attr('class', '');
			jQuery('#jform_params_module_data_source').attr('gplus', '');
			jQuery('#myTabTabs li a').each(function(index, item){
				item = jQuery(item);
				if(item.html().indexOf('Facebook') >= 0 || item.html().indexOf('Twitter') >= 0){
					item.parent().addClass('hidden');
				} else {
					item.parent().removeClass('hidden');
				}
			});
		} else {
			jQuery('#jform_params_module_data_source').attr('class', '');
			jQuery('#jform_params_module_data_source').addClass('twitter');
			jQuery('#myTabTabs li a').each(function(index, item){
				item = jQuery(item);
				if(item.html().indexOf('Facebook') >= 0 || item.html().indexOf('Google') >= 0){
					item.parent().addClass('hidden');
				} else {
					item.parent().removeClass('hidden');
				}
			});
		}
	});
} 

function SocialGK5ConfigManager() {
	this.init();
}

SocialGK5ConfigManager.prototype.init = function() {
	// create additional variable to avoid problems with the scopes
	$obj = this;
	// button load
	jQuery('#config_manager_load').click( function(e) {
		e.stopPropagation();
		e.preventDefault();
	    $obj.operation('load');
	});
	// button save
	jQuery('#config_manager_save').click( function(e) {
		e.stopPropagation();
		e.preventDefault();
	   	$obj.operation('save');
	});
	// button delete
	jQuery('#config_manager_delete').click( function(e) {
		e.stopPropagation();
		e.preventDefault();
	   	$obj.operation('delete');
	});
}

SocialGK5ConfigManager.prototype.operation = function(type) {

	var current_url = window.location;
	// check if the current url has no hashes
	if((current_url + '').indexOf('#', 0) === -1) {
		// if no - put the variables
	    current_url = current_url + '&gk_module_task='+type+'&gk_module_file=' + document.id('config_manager_'+type+'_filename').get('value');    
	} else {
		// if the url has hashes - remove the hash 
	    current_url = current_url.substr(0, (current_url + '').indexOf('#', 0) - 1);
	    // and put the variables
	    current_url = current_url + '&gk_module_task='+type+'&gk_module_file=' + document.id('config_manager_'+type+'_filename').get('value');
	}
	// redirect to the url with variables
	window.location = current_url;
}
