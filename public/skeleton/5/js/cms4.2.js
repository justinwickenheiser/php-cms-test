var cms = {
	init: function() {
		// HAMBURGER
		(function() {
			var hamburger = document.getElementById('gv-hamburger');	
			if (hamburger) {
				var navigation = document.getElementById('cms-navigation');
				if (navigation !== null) {
					hamburger.removeAttribute('href');
					hamburger.setAttribute('aria-controls', 'cms-navigation-mobile');
					// copy the navigation DOM
					cms.navigationMobile = document.createElement('div');
					cms.navigationMobile.id = 'cms-navigation-mobile';
					cms.navigationMobile.className = 'navigation navigation-mobile hide-print';
					cms.navigationMobile.appendChild(navigation.getElementsByTagName('*')[0].cloneNode(true));
					// since there will be 2 role="navigation" elements, we must label them differently for a11y
					cms.navigationMobile.querySelectorAll('[role="navigation"]')[0].setAttribute('aria-label', 'Mobile Navigation');
					navigation.querySelectorAll('[role="navigation"]')[0].setAttribute('aria-label', 'Main Navigation');
					// make the navigation copy accessible
					var a = cms.navigationMobile.querySelectorAll('li.navigation-sub > a'),
					fnOnClick = function() {
						// open/close the current navigation item
						if (!cms.helper.hasClass(this.parentNode, 'selected')) {
							cms.helper.addClass(this.parentNode, 'selected');
							this.setAttribute('aria-expanded', 'true');
							this.parentNode.getElementsByTagName('a')[1].focus();
						} else {
							cms.helper.removeClass(this.parentNode, 'selected');
							this.setAttribute('aria-expanded', 'false');
						}
						return false;
					},
					i,
					j,
					a2;
					for (i=0;i<a.length;i++) {
						a[i].setAttribute('aria-expanded', 'false');
						a[i].setAttribute('aria-haspopup', 'true');
						a[i].setAttribute('aria-controls', 'cms-navigation-mobile-sub-' + (i+1));
						a[i].id = 'cms-navigation-mobile-label-' + (i+1);
						a[i].onclick = fnOnClick;
						a[i].parentNode.getElementsByTagName('ul')[0].id = 'cms-navigation-mobile-sub-' + (i+1);
						a2 = a[i].parentNode.querySelectorAll('#cms-navigation-mobile-sub-' + (i+1) + ' a');
						for (j=0;j<a2.length;j++) {
							a2[j].id = 'cms-navigation-mobile-label-' + (i+1) + '-' + (j+1);
							a2[j].setAttribute('aria-labelledby', 'cms-navigation-mobile-label-' + (i+1) + ' cms-navigation-mobile-label-' + (i+1) + '-' + (j+1));
						}
					}
					// insert the navigation menu into the DOM
					document.querySelector('.header').appendChild(cms.navigationMobile);
					// add controls for the hamburger menu
					hamburger.onclick = function() {
						if (cms.helper.hasClass(document.body, 'hamburger-open')) {
							cms.helper.removeClass(document.body, 'hamburger-open');
							hamburger.setAttribute('aria-expanded', 'false');
						} else {
							cms.helper.addClass(document.body, 'hamburger-open');
							hamburger.setAttribute('aria-expanded', 'true');
							cms.navigationMobile.querySelectorAll('li:first-child a:first-child')[0].focus();
						}
						// prevent bubbling
						return false;
					};
					hamburger.onkeydown = function(e) {
						var keyCode;
						if (e && !e.ctrlKey && !e.altKey && !e.metaKey) {
							keyCode = e.which;
						} else if (!e && !event.ctrlKey && !event.altKey) {
							keyCode = event.keyCode;
						}
						if (keyCode == 13 || keyCode == 32) {
							this.onclick();
							return false;
						}
					};

					// 8/9/21 - When on the last menu item, if a tab key is pressed, then focus on the search
					cms.navigationMobile.onkeydown = function(e) {
						var keyCode = e.keyCode || e.which;
						if (keyCode == 9 && !e.shiftKey) {
							// are we focused on the last visible <li><a>...</a></li>?
							var el = cms.navigationMobile.querySelectorAll('a');
							for (var i = el.length-1; i >= 0; i--) {
								if (el[i].offsetParent !== null) { // visible?
									if (el[i] === document.activeElement) {
										document.getElementById('gv-search-input').focus();
										return false;
									} else {
										break; // it's not the last one: ignored
									}
								}
							}
						}
					};
					// 8/9/21 - When on the first menu item, if a shift+tab key is pressed, then close the hamburger so it doesn't target the search which we'll address next
					cms.navigationMobile.querySelectorAll('li:first-child a:first-child')[0].onkeydown = function(e) {
						var keyCode = e.keyCode || e.which;
						if (keyCode == 9 && e.shiftKey) {
							hamburger.onclick();
						}
					};
					// 8/9/21 - When on the search, if a tab key is pressed, then close the hamburger menu
					document.getElementById('gv-search-input').onkeydown = function(e) {
						var keyCode = e.keyCode || e.which;
						if (keyCode == 9 && !e.shiftKey) {
							hamburger.onclick();
						} else if (keyCode == 9 && e.shiftKey) {
							// find and focus on the last visible <li><a>...</a></li>
							var el = cms.navigationMobile.querySelectorAll('a');
							for (var i = el.length-1; i >= 0; i--) {
								if (el[i].offsetParent !== null) { // visible?
									el[i].focus();
									break;
								}
							}
							return false;
						}
					};
				}
			}
		})();
		// NAVIGATION
		(function() {
			var navigation = document.getElementById('cms-navigation');
			if (navigation !== null) {
				var fnOnKeyDown = function(e) {
					var keyCode,
						a = this.getElementsByTagName('a')[0],
						a2,
						isOpen = cms.helper.hasClass(this, 'selected'),
						i,
						li,
						el,
						currentIndex;
					if (e && !e.ctrlKey && !e.altKey && !e.metaKey) {
						keyCode = e.which;
					} else if (!e && !event.ctrlKey && !event.altKey) {
						keyCode = event.keyCode;
					}
					// ARROW-LEFT or ARROW-RIGHT
					if (keyCode == 37 || keyCode == 39) {
						var sibling = this;
						// Since there is the "|" list item, we need to make sure to ignore that
						do {
							// left arrow
							if (keyCode == 37) {
								sibling = sibling.previousElementSibling;
							// right arrow
							} else if (keyCode == 39) {
								sibling = sibling.nextElementSibling;
							}
							if (sibling != null) {
								a2 = sibling.getElementsByTagName('a');
								if (a2.length) {
									// close all of the panels that are open
									li = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.selected');
									for (i=0;i<li.length;i++) {
										cms.helper.removeClass(li[i], 'selected');
										li[i].getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
									}
									// if there was a panel that was open prior to closing them...
									if (li.length && cms.helper.hasClass(sibling, 'navigation-sub')) {
										// open the next/previous tab and select the first item in the panel
										cms.helper.addClass(sibling, 'selected');
										sibling.getElementsByTagName('a')[0].setAttribute('aria-expanded', 'true');
									}
									// focus on the tab's <a>
									a2[0].focus();
								}
							}
						} while (sibling != null && sibling.getAttribute('aria-hidden') != null);
						return false;
					// ENTER or SPACE or ARROW-DOWN or ARROW-UP
					} else if (keyCode == 13 || keyCode == 32 || document.activeElement === a && keyCode == 40) {
						// the active element (:focus) is the first link in the dropdown (the root) and it has a sub navigation
						if (document.activeElement === a && cms.helper.hasClass(a.parentNode, 'navigation-sub')) {
							// on top level <a>
							li = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.selected');
							for (i=0;i<li.length;i++) {
								cms.helper.removeClass(li[i], 'selected');
								li[i].getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
							}
							if (keyCode == 40 || !isOpen) {
								cms.helper.addClass(this, 'selected');
								this.getElementsByTagName('a')[0].setAttribute('aria-expanded', 'true');
								// select first link in the panel
								this.querySelectorAll('a')[1].focus();
							}
							return false;
						} else if (keyCode == 40 || keyCode == 32) {
							// prevent scrolling
							return false;
						}
					// ARROW-UP or ARROW-DOWN
					} else if (document.activeElement !== a && (keyCode == 38 || keyCode == 40)) {
						a = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.selected ul a');
						currentIndex = 0;
						for (i=0;i<a.length;i++) {
							if (a[i] === document.activeElement) {
								currentIndex = i;
								break;
							}
						}
						// ARROW-DOWN
						if (keyCode == 40) {
							if (currentIndex+1 != a.length) {
								a[currentIndex+1].focus();
							} else {
								// open next tab?
							}
						// ARROW-UP
						} else if (keyCode == 38) {
							if (currentIndex !== 0) {
								a[currentIndex-1].focus();
							} else {
								// open previous tab?
							}
						}
						return false;
					// ARROW-UP
					} else if (keyCode == 38) {
						// prevent scrolling
						return false;
					// ESC
					} else if (keyCode == 27) {
						if (cms.helper.hasClass(this, 'navigation-sub')) {
							cms.helper.removeClass(this, 'selected');
							this.getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
							a.focus();
							if (cms.navigation.timeout1) {
								clearTimeout(cms.navigation.timeout1);
								cms.navigation.timeout1 = null;
							}
							if (cms.navigation.timeout2) {
								clearTimeout(cms.navigation.timeout2);
								cms.navigation.timeout2 = null;
							}
						}
						return false;
					// END
					} else if (keyCode == 35) {
						if (document.activeElement === a) {
							// jump to last item in top level navigation
							el = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li');
							el[el.length-1].getElementsByTagName('a')[0].focus();
							return false;
						} else {
							// jump to last item in dropdown
							el = document.activeElement.parentNode.parentNode.getElementsByTagName('a');
							el[el.length-1].focus();
							return false;
						}
					// HOME
					} else if (keyCode == 36) {
						if (document.activeElement === a) {
							// jump to first item in top level navigation
							document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li')[0].getElementsByTagName('a')[0].focus();
							return false;
						} else {
							// jump to first item in dropdown
							document.activeElement.parentNode.parentNode.getElementsByTagName('a')[0].focus();
							return false;
						}
					}
				};
				var fnOnFocus = function() {
					if (cms.navigation.timeout1) {
						clearTimeout(cms.navigation.timeout1);
						cms.navigation.timeout1 = null;
					}
					var ul = document.querySelector('#cms-navigation [role="navigation"] > ul');
					if (this.parentNode.parentNode === ul) {
						var li = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.navigation-sub.selected');
						for (var i=0;i<li.length;i++) {
							if (li[i] !== this.parentNode) {
								cms.helper.removeClass(li[i], 'selected');
								li[i].getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
							}
						}
					}
				};
				var fnOnBlur = function() {
					cms.navigation.timeout1 = window.setTimeout(function () {
						var li = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.selected');
						for (var i=0;i<li.length;i++) {
							if (li[i].getElementsByTagName('a')[0] !== document.activeElement) {
								cms.helper.removeClass(li[i], 'selected');
								li[i].getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
							}
						}
					}, 10);
				};
				// make the navigation accessible
				var a,
					i,
					j,
					a2;
				//navigation.querySelector('ul').setAttribute('role', 'menubar');
				a = navigation.querySelectorAll('li.navigation-sub > a');
				for (i=0;i<a.length;i++) {
					a[i].setAttribute('aria-expanded', 'false');
					a[i].setAttribute('aria-haspopup', 'true');
					a[i].setAttribute('aria-controls', 'cms-navigation-sub-' + (i+1));
					a[i].id = 'cms-navigation-label-' + (i+1);
					a[i].parentNode.getElementsByTagName('ul')[0].id = 'cms-navigation-sub-' + (i+1);
					a2 = a[i].parentNode.querySelectorAll('#cms-navigation-sub-' + (i+1) + ' a');
					for (j=0;j<a2.length;j++) {
						a2[j].id = 'cms-navigation-label-' + (i+1) + '-' + (j+1);
						a2[j].setAttribute('aria-labelledby', 'cms-navigation-label-' + (i+1) + ' cms-navigation-label-' + (i+1) + '-' + (j+1));
					}
				}
				// apply keydown event to the parent <li>, which everything will bubble to
				var li = navigation.querySelectorAll('[role="navigation"] > ul > li');
				for (i=0;i<li.length;i++) {
					li[i].onkeydown = fnOnKeyDown;
				}
				// add onclick event to the top <a> of every nav item
				var fnOnClick = function() {
					var isOpen = cms.helper.hasClass(this.parentNode, 'selected'),
						li = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.selected');
					// horizontal navigation - close all other dropdowns, and open the current one if it isn't already
					if (!document.querySelectorAll('#cms-navigation.navigation-vertical').length) {
						for (i=0;i<li.length;i++) {
							cms.helper.removeClass(li[i], 'selected');
							li[i].getElementsByTagName('a')[0].setAttribute('aria-expanded', 'false');
						}
						if (!isOpen) {
							cms.helper.addClass(this.parentNode, 'selected');
							this.setAttribute('aria-expanded', 'true');
						}
					// vertical navigation - leave all other dropdowns open, but toggle the current one
					} else {
						if (!isOpen) {
							cms.helper.addClass(this.parentNode, 'selected');
							this.setAttribute('aria-expanded', 'true');
						} else {
							cms.helper.removeClass(this.parentNode, 'selected');
							this.setAttribute('aria-expanded', 'false');
						}
					}
					return false;
				};
				a = document.querySelectorAll('#cms-navigation [role="navigation"] > ul > li.navigation-sub > a');
				for (i=0;i<a.length;i++) {
					a[i].onclick = fnOnClick;
				}
				// do not apply the following events to vertical navigation: .navigation-vertical
				if (!document.querySelectorAll('#cms-navigation.navigation-vertical').length) {
					// add onfocus and onblur timeout mechanics to each <a> anywhere in the navigation
					a = document.querySelectorAll('#cms-navigation a');
					for (i=0;i<a.length;i++) {
						a[i].onfocus = fnOnFocus;
						a[i].onblur = fnOnBlur;
					}
				}
			}
		})();
		// FLAVORINFO
		(function() {
			var flavorinfo = document.getElementById('gv-flavorinfo');	
			if (flavorinfo) {
				flavorinfo.removeAttribute('href');
				flavorinfo.setAttribute('aria-expanded', 'false');
				cms.helper.removeClass(flavorinfo, 'hide-sm');
				flavorinfo.onclick = function() {
					if (cms.helper.hasClass(document.body, 'flavorinfo-open')) {
						cms.helper.removeClass(document.body, 'flavorinfo-open');
						flavorinfo.setAttribute('aria-expanded', 'false');
					} else {
						cms.helper.addClass(document.body, 'flavorinfo-open');
						flavorinfo.setAttribute('aria-expanded', 'true');
						//document.getElementById(flavorinfo.getAttribute('aria-controls')).focus();
					}
				};
				flavorinfo.onkeydown = function(e) {
					var keyCode;
					if (e && !e.ctrlKey && !e.altKey && !e.metaKey) {
						keyCode = e.which;
					} else if (!e && !event.ctrlKey && !event.altKey) {
						keyCode = event.keyCode;
					}
					if (keyCode == 13 || keyCode == 32) {
						this.onclick();
						return false;
					}
				};
			}
		})();
	},
	navigation: {
		timeout1: null,
		timeout2: null
	},
	toggleAccordion: function(el) {
		var panel = el.parentNode;
		if (!cms.helper.hasClass(panel, 'chunk-module-accordion-open')) {
			cms.helper.addClass(panel, 'chunk-module-accordion-open');
			cms.helper.setClass(panel.getElementsByTagName('span')[0], 'icon icon-chevron-up');
			el.setAttribute('aria-expanded', 'true');
		} else {
			cms.helper.removeClass(panel, 'chunk-module-accordion-open');
			cms.helper.setClass(panel.getElementsByTagName('span')[0], 'icon icon-chevron-down');
			el.setAttribute('aria-expanded', 'false');
		}
		return false;
	},
	helper: {
		event: function(event, el, func) {
			if (el.addEventListener) {
				el.addEventListener(event, func, false);
			} else {
				el.attachEvent('on' + event, func);
			}
		},
		trim: function(str) {
			if (str) {
				return str.replace(/^\s+|\s+$/g, '');
			}
			return '';
		},
		hasClass: function(el, c) {
			return (' ' + el.className + ' ').indexOf(' ' + c + ' ') !== -1;
		},
		getClass: function(el) {
			if (el.className) {
				return cms.helper.trim(el.className);
			}
			return '';
		},
		setClass: function(el, c) {
			el.className = c;
		},
		addClass: function(el, c) {
			if (!cms.helper.hasClass(el, c)) {
				el.className = cms.helper.trim(el.className + '  ' + c);
			}
		},
		removeClass: function(el, c) {
			var c2 = ' ' + cms.helper.getClass(el) + ' ';
			c2 = c2.replace((' ' + c + ' '), '');
			el.className = cms.helper.trim(c2);
		},
		toggleClass: function(el, c) {
			if (!cms.helper.hasClass(el, c)) {
				cms.helper.addClass(el, c);
			} else {
				cms.helper.removeClass(el, c);
			}
		},
		ajax: function(url, func) {
			if (window.XMLHttpRequest) {
				cms.AJAX = new XMLHttpRequest();
			} else {
				cms.AJAX = new ActiveXObject("Microsoft.XMLHTTP");
			}
			if (cms.AJAX == null) {
				return false;
			}
			cms.AJAX.onreadystatechange = function() {
				if (cms.AJAX.readyState == 4 || cms.AJAX.readyState == "complete") {
					func();
				}
			};
			/*
			if (url.indexOf('?') !== -1) {
				url += '&t=' + Math.random();
			} else {
				url += '?t=' + Math.random();
			}
			*/
			cms.AJAX.open('GET', url, true);
			cms.AJAX.send(null);
		}
	}
};
cms.helper.event('load', window, cms.init);