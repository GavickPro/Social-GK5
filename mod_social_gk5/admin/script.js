/*
 *
 * Main Social GK5 back-end script
 *
 */

// DOMContentLoaded event
window.addEvent("domready",function(){
	// initialize the configuration manager
	var configManager = new SocialGK5ConfigManager();
	
	// initialize the main class
	var settings = new SocialGK5Settings();

	$$('.input-pixels').each(function(el){el.getParent().innerHTML = "<div class=\"input-prepend\">" + el.getParent().innerHTML + "<span class=\"add-on\">px</span></div>"});
	$$('.input-ms').each(function(el){el.getParent().innerHTML = "<div class=\"input-prepend\">" + el.getParent().innerHTML + "<span class=\"add-on\">ms</span></div>"});
	$$('.input-percents').each(function(el){el.getParent().innerHTML = "<div class=\"input-prepend\">" + el.getParent().innerHTML + "<span class=\"add-on\">%</span></div>"});
	$$('.input-minutes').each(function(el){el.getParent().innerHTML = "<div class=\"input-prepend\">" + el.getParent().innerHTML + "<span class=\"add-on\">minutes</span></div>"});
	$$('.input-gplus').each(function(el){el.getParent().innerHTML = "<div class=\"input-prepend\"><span class=\"add-on\">http://plus.google.com/</span>" + el.getParent().innerHTML + "</div>"});
	
	
	
	$$('.gkFormLine').each(function(el){el.getParent().setStyle('margin-left', '5px') });
	document.id('jform_params_required_field').getParent().innerHTML = "<span class=\"required\">APP ID is required for this plugin</span>";
	document.id('config_manager_form').getParent().setStyle('margin-left', '10px');
	document.id('gk_about_us').getParent().setStyle('margin-left', '10px');

	
});

/*
 *
 * Main class
 *
 */
var SocialGK5Settings = new Class({
	// constructor
	initialize: function() {
		// helper handler
		$this = this;
		this.formInit();
		// columns/rows view
		var merge = document.id('jform_params_twitter_columns-lbl').getParent();
		var rows = document.id('jform_params_twitter_rows-lbl').getParent();
		var columns = merge.get('html');
		merge.setStyle('display', 'none');
		rows.innerHTML = rows.innerHTML + columns;
		merge.destroy();
		

		// current mode
		var sourceMode = document.id('jform_params_module_data_source').get('value');
				if(sourceMode == 'fb') {
					document.id('jform_params_module_data_source').addClass('fb');
					console.log('fb');
					$$('#moduleOptions .accordion-group .accordion-heading a').each(function(item, index){
						console.log(item);
						console.log(item.get('html'));
						if(String.from(item.get('html')).contains('TWITTER')==true || String.from(item.get('html')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else if (sourceMode == 'gplus') {
					document.id('jform_params_module_data_source').addClass('gplus');
					$$('ul.nav li a').each(function(item, index){
						if(String.from(item.get('href')).contains('SOCIAL_FB')==true || String.from(item.get('href')).contains('TWITTER')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else {
					document.id('jform_params_module_data_source').addClass('twitter');
					$$('ul.nav li a').each(function(item, index){
						if(String.from(item.get('href')).contains('Facebook')==true || String.from(item.get('href')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				}
		// hide one of unnecessary tabs
		document.id('jform_params_module_data_source').addEvent('change', function() {
				sourceMode = document.id('jform_params_module_data_source').get('value');
				if(sourceMode == 'fb') {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('fb');
					$$('#moduleOptions .accordion-group .accordion-heading a').each(function(item, index){
						if(String.from(item.get('html')).contains('Twitter')==true || String.from(item.get('html')).contains('Google')==true){
							item.getParent().getParent().getParent().addClass('hidden');
						} else {
							item.getParent().getParent().getParent().removeClass('hidden');
						}
					});
				} else if (sourceMode == 'gplus') {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('gplus');
					$$('#moduleOptions .accordion-group .accordion-heading a').each(function(item, index){
						if(String.from(item.get('html')).contains('Facebook')==true || String.from(item.get('html')).contains('Twitter')==true){
							item.getParent().getParent().getParent().addClass('hidden');
						} else {
							item.getParent().getParent().getParent().removeClass('hidden');
						}
					});
				} else {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('twitter');
					$$('#moduleOptions .accordion-group .accordion-heading a').each(function(item, index){
						if(String.from(item.get('html')).contains('Facebook')==true || String.from(item.get('html')).contains('Google')==true){
							item.getParent().getParent().getParent().addClass('hidden');
						} else {
							item.getParent().getParent().getParent().removeClass('hidden');
						}
					});
				}
		});
		
		// function used for changing data source to help if the onChange event doesn't fire
		document.id('jform_params_module_data_source').addEvent('blur', function() {
			document.id('jform_params_module_data_source').fireEvent('change');	
		});
	},
	
	// function used to make other adjustments in the form
	formInit: function() {

	},
	
		
	// function to encode chars
	htmlspecialchars: function(string) {
	    string = string.toString();
	    string = string.replace(/&/g, '[ampersand]').replace(/</g, '[leftbracket]').replace(/>/g, '[rightbracket]');
	    return string;
	},
	// function to decode chars
	htmlspecialchars_decode: function(string) {
		string = string.toString();
		string = string.replace(/\[ampersand\]/g, '&').replace(/\[leftbracket\]/g, '<').replace(/\[rightbracket\]/g, '>');
		return string;
	}
});

/*
 *
 * Configuration manager class
 *
 */
var SocialGK5ConfigManager = new Class({
	// constructor
	initialize: function() {
		// create additional variable to avoid problems with the scopes
		$obj_c = this;
		// button load
		document.id('config_manager_load').addEvent('click', function(e) {
			e.stop();
		    $obj_c.operation('load');
		});
		// button save
		document.id('config_manager_save').addEvent('click', function(e) {
			e.stop();
		   	$obj_c.operation('save');
		});
		document.id('config_manager_delete').addEvent('click', function(e) {
			e.stop();
		   	$obj_c.operation('delete');
		});
	},
	// operation made by the class
	operation: function(type) {
		// current url 

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
});