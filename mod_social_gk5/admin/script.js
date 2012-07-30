/*
 *
 * Main Social GK5 back-end script
 *
 */

// DOMContentLoaded event
window.addEvent("domready",function(){
	// initialize the configuration manager
	var configManager = new SocialGK5ConfigManager();
	// get lists
	getLists();
	// initialize twitter lists 
	var twitterLists = new SocialGK5TwitterList();
	// initialize the main class
	var settings = new SocialGK5Settings();
	// get the updates
	settings.getUpdates();
	// intialize color picker
	DynamicColorPicker.auto(".color-field");
	
	$$('.gk_switch').each(function(el){
		el.setStyle('display','none');
		var style = (el.value == 'true' || el.value == 1) ? 'on' : 'off';
		var switcher = new Element('div',{'class' : 'switcher-'+style});
		switcher.inject(el, 'after');
		switcher.addEvent("click", function(){
			if(el.value == 'true' || el.value=='false') {
			if(el.value == 'true'){
				switcher.setProperty('class','switcher-off');
				el.value = 'false';
			}else{
				switcher.setProperty('class','switcher-on');
				el.value = 'true';
			}
			} else {
			if(el.value == 1){
				switcher.setProperty('class','switcher-off');
				el.value = 0;
			}else{
				switcher.setProperty('class','switcher-on');
				el.value = 1;
			}
			}
		});
	});
	$$('.px').each(function(el){el.getParent().innerHTML = el.getParent().innerHTML + "<span class=\"unit\">px</span>"});
	document.id('jform_params_required_field').getParent().innerHTML = "<span class=\"required\">APP ID is required for this plugin</span>";
	hideTwitterOptions();
	
	
	
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
		
		//minutes in cache
		document.id('jform_params_twitter_cache_time-lbl').getParent().innerHTML = document.id('jform_params_twitter_cache_time-lbl').getParent().innerHTML + '<span class="minutes">minutes</span>';
		
		// current mode
		var sourceMode = document.id('jform_params_module_data_source').get('value');
				if(sourceMode == 'fb') {
					document.id('jform_params_module_data_source').addClass('fb');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('TWITTER')==true || String.from(item.get('id')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else if (sourceMode == 'gplus') {
					document.id('jform_params_module_data_source').addClass('gplus');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('SOCIAL_FB')==true || String.from(item.get('id')).contains('TWITTER')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else {
					document.id('jform_params_module_data_source').addClass('twitter');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('SOCIAL_FB')==true || String.from(item.get('id')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				}
			
		document.id('jform_params_twitter_preview-lbl').setStyle('display', 'none');
	
		// hide one of unnecessary tabs
		document.id('jform_params_module_data_source').addEvent('change', function() {
				sourceMode = document.id('jform_params_module_data_source').get('value');
				if(sourceMode == 'fb') {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('fb');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('TWITTER')==true || String.from(item.get('id')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else if (sourceMode == 'gplus') {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('gplus');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('SOCIAL_FB')==true || String.from(item.get('id')).contains('TWITTER')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				} else {
					document.id('jform_params_module_data_source').removeAttribute('class');
					document.id('jform_params_module_data_source').addClass('twitter');
					$$('.panel h3').each(function(item, index){
						if(String.from(item.get('id')).contains('SOCIAL_FB')==true || String.from(item.get('id')).contains('GPLUS')==true){
							item.getParent().addClass('hidden');
						} else {
							item.getParent().removeClass('hidden');
						}
					});
				}
		});
		
		document.id('jform_params_twitter_widget').addEvent('change', function() {
				// now hide part of layout options
				hideTwitterOptions();	
		});
		
		var listSource =  document.id('jform_params_twitter_lists').value;
		document.id('jform_params_twitter_lists').addEvent('change', function() {
			listSource =  document.id('jform_params_twitter_lists').value;
			document.id('jform_params_twitter_lists_data').set('value', listSource);
			
		});
		
		// set colors for tweeter preview
		$$('.twtr-hd h3').setStyle('color', document.id('jform_params_twitter_widget_text_color').get('value'));
		$$('.twtr-hd h4 a').setStyle('color', document.id('jform_params_twitter_widget_text_color').get('value'));
		$$('a.twtr-join-conv').setStyle('color',  document.id('jform_params_twitter_widget_text_color').get('value'));
		$$('.twtr-doc').setStyle('background', document.id('jform_params_twitter_widget_color').get('value'));
		$$('.twtr-timeline').setStyle('background', document.id('jform_params_twitter_tweet_color').get('value'));
		$$('.twtr-tweet-text a').setStyle('color', document.id('jform_params_twitter_link_color').get('value'));
		$$('.twtr-tweet-text > p').setStyle('color', document.id('jform_params_twitter_tweet_text_color').get('value'));
		
		// function used for changing data source to help if the onChange event doesn't fire
		document.id('jform_params_module_data_source').addEvent('blur', function() {
			document.id('jform_params_module_data_source').fireEvent('change');	
		});
	},
	
	// function used to make other adjustments in the form
	formInit: function() {
		// fix the width of the options when the browser window is too small
		document.id('module-sliders').getParent().setStyle('position','relative');
		//
		var baseW = document.id('module-sliders').getSize().x;
		var minW = 540;
		//
		if(baseW < minW) {
			document.id('module-sliders').setStyles({
				"position": "absolute",
				"background": "white",
				"width": baseW + "px",
				"padding": "8px",
				"-webkit-box-shadow": "-8px 0 15px #aaa",
				"-moz-box-shadow": "-8px 0 15px #aaa",
				"box-shadow": "-8px 0 15px #aaa"
			});
	
			var WidthFX = new Fx.Morph(document.id('module-sliders'), {duration: 150});
			var mouseOver = false;
	
			document.id('module-sliders').addEvent('mouseenter', function() {
				mouseOver = true;
				WidthFX.start({
					'width': minW,
					'margin-left': (-1 * (minW - baseW))
				});
			});
	
			document.id('module-sliders').addEvent('mouseleave', function() {
				mouseOver = false;
				(function() {
					if(!mouseOver) {
						WidthFX.start({
							'width': baseW,
							'margin-left': 0
						});
					}
				}).delay(750);
			});
		}
		$$('.panel h3.title').each(function(panel) {
			panel.addEvent('click', function(){
				if(panel.hasClass('pane-toggler')) {
					(function(){ 
						panel.getParent().getElement('.pane-slider').setStyle('height', 'auto'); 
					}).delay(750);
				
					(function() {
						var myFx = new Fx.Scroll(window, { duration: 150 }).toElement(panel);
					}).delay(250);
				}	
			});
		});
		
		
	},
	
	formInit: function() {
		// fix the width of the options when the browser window is too small
		document.id('module-sliders').getParent().setStyle('position','relative');
		//
		var baseW = document.id('module-sliders').getSize().x;
		var minW = 540;
		//
		if(baseW < minW) {
			document.id('module-sliders').setStyles({
				"position": "absolute",
				"background": "white",
				"width": baseW + "px",
				"padding": "8px",
				"-webkit-box-shadow": "-8px 0 15px #aaa",
				"-moz-box-shadow": "-8px 0 15px #aaa",
				"box-shadow": "-8px 0 15px #aaa"
			});
	
			var WidthFX = new Fx.Morph(document.id('module-sliders'), {duration: 150});
			var mouseOver = false;
	
			document.id('module-sliders').addEvent('mouseenter', function() {
				mouseOver = true;
				WidthFX.start({
					'width': minW,
					'margin-left': (-1 * (minW - baseW))
				});
			});
	
			document.id('module-sliders').addEvent('mouseleave', function() {
				mouseOver = false;
				(function() {
					if(!mouseOver) {
						WidthFX.start({
							'width': baseW,
							'margin-left': 0
						});
					}
				}).delay(750);
			});
		}
		$$('.panel h3.title').each(function(panel) {
			panel.addEvent('click', function(){
				if(panel.hasClass('pane-toggler')) {
					(function(){ 
						panel.getParent().getElement('.pane-slider').setStyle('height', 'auto'); 
					}).delay(750);
				
					(function() {
						var myFx = new Fx.Scroll(window, { duration: 150 }).toElement(panel);
					}).delay(250);
				}	
			});
		});
		
	},
	
	// function used to generate the updates list
	getUpdates: function() {
		var update_url = 'https://www.gavick.com/component/gk2_update/?task=json&tmpl=json&query=product&product=mod_social_gk5';
		var update_div = document.id('gk_module_updates');
		// remove unnecesary label
		document.id('jform_params_module_updates-lbl').destroy(); 
		// set the necessary content
		update_div.innerHTML = '<div id="gk_update_div"><span id="gk_loader"></span>Loading update data from GavicPro Update service...</div>';
		// get the data from the server
		new Asset.javascript(update_url,{
			id: "new_script",
			onload: function(){
				content = '';
				// read the update JSON data
				$GK_UPDATE.each(function(el){
					content += '<li><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '" target="_blank">Download</a></span></li>';
				});
				// fill the container with it
				update_div.innerHTML = '<ul class="gk_updates">' + content + '</ul>';
				// if there is no updates - set the proper information
				if(update_div.innerHTML == '<ul class="gk_updates"></ul>') {
					update_div.innerHTML = '<p>There is no available updates for this module</p>';	
				}
			}
		});
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

var SocialGK5TwitterList = new Class({
	// constructor
	initialize: function() {
		// create additional variable to avoid problems with the scopes
		$obj = this;
		var selects = null;
		var content = '';
		// button load
		document.id('twitter_load_lists').addEvent('click', function(e) {
			e.stop();
		    $obj.operation('load');
		});
	},
	// operation made by the class
	operation: function(type) {
		// current username
		getLists();
		
	} 
});

// get twitter lists for selected user
function getLists() {
	var username = document.id('jform_params_twitter_username').get('value');
		var url = 'https://api.twitter.com/1/lists/all.json';
		content = '';
		new Request.JSONP({
		  url: "https://api.twitter.com/1/lists/all.json",
		  data: {
			screen_name: username
		  },
		  onComplete: function(lists) {
			if(lists.length > 0) {
				var sel = document.id('jform_params_twitter_lists_data').value; 
				Array.each(lists, function(list, index){
					if(sel == list.slug) {
					content+='<option value="'+list.slug+'" selected="selected">'+list.name+'</option>';
					} else {
					content+='<option value="'+list.slug+'">'+list.name+'</option>';
					}
				});
			} else {
					content+='<option value="error">No lists for specified username</option>';
			}
			document.id('jform_params_twitter_lists').innerHTML = '';
			document.id('jform_params_twitter_lists').innerHTML = content;
			
		  }
		}).send();
		
		document.id('jform_params_twitter_lists').set('value', document.id('jform_params_twitter_lists_data').value);
}

function hideTwitterOptions() {
	if(document.id('jform_params_twitter_widget').value == 'tweets') {
						document.id('jform_params_twitter_username-lbl').getParent().addClass('hidden');
						document.id('jform_params_twitter_title-lbl').getParent().addClass('hidden');
						document.id('jform_params_twitter_desc-lbl').getParent().addClass('hidden');
						document.id('jform_params_twitter_lists-lbl').getParent().addClass('hidden');
						document.id('jform_params_twitter_preview-lbl').getParent().getAllPrevious().each(function(item, index) {
							item.addClass('hidden');
							document.id('jform_params_twitter_preview-lbl').getParent().addClass('hidden');
						});
						document.id('jform_params_twitter_preview-lbl').getParent().getAllNext().each(function(item, index) {
							item.removeClass('hidden');
						});
					} else {
						document.id('jform_params_twitter_username-lbl').getParent().removeClass('hidden');
						document.id('jform_params_twitter_title-lbl').getParent().removeClass('hidden');
						document.id('jform_params_twitter_desc-lbl').getParent().removeClass('hidden');
						document.id('jform_params_twitter_lists-lbl').getParent().removeClass('hidden');
						document.id('jform_params_twitter_preview-lbl').getParent().getAllNext().each(function(item, index) {
							item.addClass('hidden');
						});
						document.id('jform_params_twitter_preview-lbl').getParent().getAllPrevious().each(function(item, index) {
							item.removeClass('hidden');
							document.id('jform_params_twitter_preview-lbl').getParent().removeClass('hidden');
						});
					}
}

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