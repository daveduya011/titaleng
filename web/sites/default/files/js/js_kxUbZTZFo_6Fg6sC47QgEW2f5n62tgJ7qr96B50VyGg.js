/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Drupal, debounce, CKEDITOR, $, displace, AjaxCommands) {
  Drupal.editors.ckeditor = {
    attach: function attach(element, format) {
      this._loadExternalPlugins(format);

      format.editorSettings.drupal = {
        format: format.format
      };

      var label = $('label[for=' + element.getAttribute('id') + ']').html();
      format.editorSettings.title = Drupal.t('Rich Text Editor, !label field', {
        '!label': label
      });

      return !!CKEDITOR.replace(element, format.editorSettings);
    },
    detach: function detach(element, format, trigger) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        if (trigger === 'serialize') {
          editor.updateElement();
        } else {
          editor.destroy();
          element.removeAttribute('contentEditable');
        }
      }
      return !!editor;
    },
    onChange: function onChange(element, callback) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        editor.on('change', debounce(function () {
          callback(editor.getData());
        }, 400));

        editor.on('mode', function () {
          var editable = editor.editable();
          if (!editable.isInline()) {
            editor.on('autoGrow', function (evt) {
              var doc = evt.editor.document;
              var scrollable = CKEDITOR.env.quirks ? doc.getBody() : doc.getDocumentElement();

              if (scrollable.$.scrollHeight < scrollable.$.clientHeight) {
                scrollable.setStyle('overflow-y', 'hidden');
              } else {
                scrollable.removeStyle('overflow-y');
              }
            }, null, null, 10000);
          }
        });
      }
      return !!editor;
    },
    attachInlineEditor: function attachInlineEditor(element, format, mainToolbarId, floatedToolbarId) {
      this._loadExternalPlugins(format);

      format.editorSettings.drupal = {
        format: format.format
      };

      var settings = $.extend(true, {}, format.editorSettings);

      if (mainToolbarId) {
        var settingsOverride = {
          extraPlugins: 'sharedspace',
          removePlugins: 'floatingspace,elementspath',
          sharedSpaces: {
            top: mainToolbarId
          }
        };

        var sourceButtonFound = false;
        for (var i = 0; !sourceButtonFound && i < settings.toolbar.length; i++) {
          if (settings.toolbar[i] !== '/') {
            for (var j = 0; !sourceButtonFound && j < settings.toolbar[i].items.length; j++) {
              if (settings.toolbar[i].items[j] === 'Source') {
                sourceButtonFound = true;

                settings.toolbar[i].items[j] = 'Sourcedialog';
                settingsOverride.extraPlugins += ',sourcedialog';
                settingsOverride.removePlugins += ',sourcearea';
              }
            }
          }
        }

        settings.extraPlugins += ',' + settingsOverride.extraPlugins;
        settings.removePlugins += ',' + settingsOverride.removePlugins;
        settings.sharedSpaces = settingsOverride.sharedSpaces;
      }

      element.setAttribute('contentEditable', 'true');

      return !!CKEDITOR.inline(element, settings);
    },
    _loadExternalPlugins: function _loadExternalPlugins(format) {
      var externalPlugins = format.editorSettings.drupalExternalPlugins;

      if (externalPlugins) {
        Object.keys(externalPlugins || {}).forEach(function (pluginName) {
          CKEDITOR.plugins.addExternal(pluginName, externalPlugins[pluginName], '');
        });
        delete format.editorSettings.drupalExternalPlugins;
      }
    }
  };

  Drupal.ckeditor = {
    saveCallback: null,

    openDialog: function openDialog(editor, url, existingValues, saveCallback, dialogSettings) {
      var $target = $(editor.container.$);
      if (editor.elementMode === CKEDITOR.ELEMENT_MODE_REPLACE) {
        $target = $target.find('.cke_contents');
      }

      $target.css('position', 'relative').find('.ckeditor-dialog-loading').remove();

      var classes = dialogSettings.dialogClass ? dialogSettings.dialogClass.split(' ') : [];
      classes.push('ui-dialog--narrow');
      dialogSettings.dialogClass = classes.join(' ');
      dialogSettings.autoResize = window.matchMedia('(min-width: 600px)').matches;
      dialogSettings.width = 'auto';

      var $content = $('<div class="ckeditor-dialog-loading"><span style="top: -40px;" class="ckeditor-dialog-loading-link">' + Drupal.t('Loading...') + '</span></div>');
      $content.appendTo($target);

      var ckeditorAjaxDialog = Drupal.ajax({
        dialog: dialogSettings,
        dialogType: 'modal',
        selector: '.ckeditor-dialog-loading-link',
        url: url,
        progress: { type: 'throbber' },
        submit: {
          editor_object: existingValues
        }
      });
      ckeditorAjaxDialog.execute();

      window.setTimeout(function () {
        $content.find('span').animate({ top: '0px' });
      }, 1000);

      Drupal.ckeditor.saveCallback = saveCallback;
    }
  };

  $(window).on('dialogcreate', function (e, dialog, $element, settings) {
    $('.ui-dialog--narrow').css('zIndex', CKEDITOR.config.baseFloatZIndex + 1);
  });

  $(window).on('dialog:beforecreate', function (e, dialog, $element, settings) {
    $('.ckeditor-dialog-loading').animate({ top: '-40px' }, function () {
      $(this).remove();
    });
  });

  $(window).on('editor:dialogsave', function (e, values) {
    if (Drupal.ckeditor.saveCallback) {
      Drupal.ckeditor.saveCallback(values);
    }
  });

  $(window).on('dialog:afterclose', function (e, dialog, $element) {
    if (Drupal.ckeditor.saveCallback) {
      Drupal.ckeditor.saveCallback = null;
    }
  });

  $(document).on('drupalViewportOffsetChange', function () {
    CKEDITOR.config.autoGrow_maxHeight = 0.7 * (window.innerHeight - displace.offsets.top - displace.offsets.bottom);
  });

  function redirectTextareaFragmentToCKEditorInstance() {
    var hash = window.location.hash.substr(1);
    var element = document.getElementById(hash);
    if (element) {
      var editor = CKEDITOR.dom.element.get(element).getEditor();
      if (editor) {
        var id = editor.container.getAttribute('id');
        window.location.replace('#' + id);
      }
    }
  }
  $(window).on('hashchange.ckeditor', redirectTextareaFragmentToCKEditorInstance);

  CKEDITOR.config.autoGrow_onStartup = true;

  CKEDITOR.timestamp = drupalSettings.ckeditor.timestamp;

  if (AjaxCommands) {
    AjaxCommands.prototype.ckeditor_add_stylesheet = function (ajax, response, status) {
      var editor = CKEDITOR.instances[response.editor_id];

      if (editor) {
        response.stylesheets.forEach(function (url) {
          editor.document.appendStyleSheet(url);
        });
      }
    };
  }
})(Drupal, Drupal.debounce, CKEDITOR, jQuery, Drupal.displace, Drupal.AjaxCommands);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, CKEDITOR) {
  var convertToOffCanvasCss = function convertToOffCanvasCss(originalCss) {
    var selectorPrefix = '#drupal-off-canvas ';
    var skinPath = '' + CKEDITOR.basePath + CKEDITOR.skinName + '/';
    var css = originalCss.substring(originalCss.indexOf('*/') + 2).trim().replace(/}/g, '}' + selectorPrefix).replace(/,/g, ',' + selectorPrefix).replace(/url\(/g, skinPath);
    return '' + selectorPrefix + css;
  };

  var insertCss = function insertCss(cssToInsert) {
    var offCanvasCss = document.createElement('style');
    offCanvasCss.innerHTML = cssToInsert;
    offCanvasCss.setAttribute('id', 'ckeditor-off-canvas-reset');
    document.body.appendChild(offCanvasCss);
  };

  var addCkeditorOffCanvasCss = function addCkeditorOffCanvasCss() {
    if (document.getElementById('ckeditor-off-canvas-reset')) {
      return;
    }

    CKEDITOR.skinName = CKEDITOR.skin.name;

    var editorCssPath = CKEDITOR.skin.getPath('editor');
    var dialogCssPath = CKEDITOR.skin.getPath('dialog');

    var storedOffCanvasCss = window.localStorage.getItem('Drupal.off-canvas.css.' + editorCssPath + dialogCssPath);

    if (storedOffCanvasCss) {
      insertCss(storedOffCanvasCss);
      return;
    }

    $.when($.get(editorCssPath), $.get(dialogCssPath)).done(function (editorCss, dialogCss) {
      var offCanvasEditorCss = convertToOffCanvasCss(editorCss[0]);
      var offCanvasDialogCss = convertToOffCanvasCss(dialogCss[0]);
      var cssToInsert = '#drupal-off-canvas .cke_inner * {background: transparent;}\n          ' + offCanvasEditorCss + '\n          ' + offCanvasDialogCss;
      insertCss(cssToInsert);

      if (CKEDITOR.timestamp && editorCssPath.indexOf(CKEDITOR.timestamp) !== -1 && dialogCssPath.indexOf(CKEDITOR.timestamp) !== -1) {
        window.localStorage.setItem('Drupal.off-canvas.css.' + editorCssPath + dialogCssPath, cssToInsert);
      }
    });
  };

  addCkeditorOffCanvasCss();
})(jQuery, CKEDITOR);;

/**
 * @file
 *
 * Fivestar JavaScript behaviors integration.
 */

/**
 * Create a degradeable star rating interface out of a simple form structure.
 *
 * Originally based on the Star Rating jQuery plugin by Wil Stuckey:
 * http://sandbox.wilstuckey.com/jquery-ratings/
 */
(function($) {
  Drupal.behaviors.fivestar = {
    attach: function(context) {
      $('.vote').on('change', function() {
        if (!$(this).prop('disabled')) {
          $(this).closest('form').find('.form-submit').trigger('click');
        }
      });

      $(context).find('div.fivestar-form-item').once('fivestar').each(function() {
        var $cancel, $container, $options, $select, $this, index;
        $this = $(this);
        $container = $('<div class="fivestar-widget clearfix"></div>');
        $select = $('select', $this);
        $cancel = $('option[value="0"]', $this);
        if ($cancel.length) {
          $('<div class="cancel"><a href="#0" title="' + $cancel.text() + '">' + $cancel.text() + '</a></div>').appendTo($container);
        }
        $options = $('option', $this).not('[value="-"], [value="0"]');
        index = -1;
        $options.each(function(i, element) {
          var classes;
          classes = 'star-' + i + 1;
          classes += (i + 1) % 2 === 0 ? ' even' : ' odd';
          classes += i === 0 ? ' star-first' : '';
          classes += i + 1 === $options.length ? ' star-last' : '';
          $('<div class="star"><a href="#' + element.value + '" title="' + element.text + '">' + element.text + '</a></div>').addClass(classes).appendTo($container);
          if (element.value === $select.val()) {
            index = i + 1;
          }
        });
        if (index !== -1) {
          $container.find('.star').slice(0, index).addClass('on');
        }
        $container.addClass('fivestar-widget-' + $options.length);
        $container.find('a').bind('click', $this, Drupal.behaviors.fivestar.rate).bind('mouseover', $this, Drupal.behaviors.fivestar.hover);
        $container.bind('mouseover mouseout', $this, Drupal.behaviors.fivestar.hover);
        $select.after($container).css('display', 'none');
      });
    },
    rate: function(event) {
      var $this, $this_star, $widget, value;
      $this = $(this);
      $widget = event.data;
      value = parseInt(this.hash.replace('#', ''));
      $('select', $widget).val(value).change();
      if (value === 0) {
        $this_star = $this.parent().parent().find('.star');
      } else {
        $this_star = $this.closest('.star');
      }
      $this_star.prevAll('.star').addBack().addClass('on');
      $this_star.nextAll('.star').removeClass('on');
      if (value === 0) {
        $this_star.removeClass('on');
      }
      event.preventDefault();
    },
    hover: function(event) {
      var $stars, $target, $this, $widget, index;
      $this = $(this);
      $widget = event.data;
      $target = $(event.target);
      $stars = $('.star', $this);
      if (event.type === 'mouseover') {
        index = $stars.index($target.parent());
        $stars.each(function(i, element) {
          if (i <= index) {
            $(element).addClass('hover');
          } else {
            $(element).removeClass('hover');
          }
        });
      } else {
        $stars.removeClass('hover');
      }
    }
  };
})(jQuery);


/**
 * @file
 *
 * Fivestar AJAX for updating fivestar widgets.
 */

/**
 * Create a degradeable star rating interface out of a simple form structure.
 */
(function($) {
  Drupal.AjaxCommands.prototype.fivestarUpdate = function(ajax, response, status) {
    response.selector = $('.fivestar-form-item', ajax.element.form);
    ajax.commands.insert(ajax, response, status);
  };
})(jQuery);
;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, _, Drupal, drupalSettings) {
  var cache = {};
  Drupal.cartFlyout = {
    templates: {},
    models: [],
    views: [],
    offcanvas: null,
    offcanvasBackground: null,
    getTemplate: function getTemplate(data) {
      var id = data.id;
      if (!cache.hasOwnProperty(id)) {
        cache[id] = {
          render: _.template(data.data)
        };
      }
      return cache[id];
    },
    createFlyout: function createFlyout() {
      var cartOffCanvas = document.createElement('aside');
      cartOffCanvas.id = 'cart-offcanvas';
      cartOffCanvas.classList.add('cart-offcanvas');
      cartOffCanvas.classList.add('is-closed');

      cartOffCanvas.classList.add('cart-offcanvas--right');

      var cartOffCanvasBg = document.createElement('div');
      cartOffCanvasBg.id = 'cart-offcanvas-bg';
      cartOffCanvasBg.classList.add('cart-offcanvas-bg');
      cartOffCanvasBg.classList.add('is-closed');
      cartOffCanvasBg.onclick = Drupal.cartFlyout.flyoutOffcanvasToggle;

      document.body.appendChild(cartOffCanvas);
      document.body.appendChild(cartOffCanvasBg);

      Drupal.cartFlyout.offcanvas = cartOffCanvas;
      Drupal.cartFlyout.offcanvasBackground = cartOffCanvasBg;
    },
    flyoutOffcanvasToggle: function flyoutOffcanvasToggle() {
      Drupal.cartFlyout.offcanvas.classList.toggle('is-open');
      Drupal.cartFlyout.offcanvas.classList.toggle('is-closed');
      Drupal.cartFlyout.offcanvasBackground.classList.toggle('is-open');
      Drupal.cartFlyout.offcanvasBackground.classList.toggle('is-closed');
    },
    fetchCarts: function fetchCarts() {
      $.get(Drupal.url('cart?_format=json'), function (json) {
        var count = json.reduce(function (previousValue, currentValue) {
          if (drupalSettings.cartFlyout.use_quantity_count) {
            return previousValue + currentValue.order_items.reduce(function (previousValue, currentValue) {
              return previousValue + parseInt(currentValue.quantity);
            }, 0);
          } else {
            return previousValue + currentValue.order_items.length;
          }
        }, 0);

        _.each(Drupal.cartFlyout.models, function (model) {
          model.set('count', count);
          model.set('carts', json);
          model.trigger('cartsLoaded', model);
        });
      });
    }
  };
  Drupal.behaviors.cartFlyout = {
    attach: function attach(context) {
      Drupal.cartFlyout.templates = drupalSettings.cartFlyout.templates;
      $(context).find('.cart-flyout').once('cart-block-render').each(function () {
        Drupal.cartFlyout.createFlyout();
        var model = new Drupal.cartFlyout.CartBlockModel(drupalSettings.cartFlyout);
        Drupal.cartFlyout.models.push(model);
        var view = new Drupal.cartFlyout.CartBlockView({
          el: this,
          model: model
        });
        var offcanvasView = new Drupal.cartFlyout.CartOffcanvasView({
          el: Drupal.cartFlyout.offcanvas,
          model: model
        });
        Drupal.cartFlyout.views.push(view);
        Drupal.cartFlyout.views.push(offcanvasView);
        Drupal.cartFlyout.fetchCarts();
      });
    }
  };
})(jQuery, _, Drupal, drupalSettings);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.cartFlyout.CartBlockModel = Backbone.Model.extend({
    defaults: {
      icon: '',

      count: 0,

      carts: [],

      countText: {
        singular: '@count item',
        plural: '@count items'
      },

      url: '',

      links: ['<a href="' + Drupal.url('cart') + '">' + Drupal.t('View cart') + '</a>']
    },
    getUrl: function getUrl() {
      return this.get('url');
    },
    getIcon: function getIcon() {
      return this.get('icon');
    },
    getCount: function getCount() {
      return this.get('count');
    },
    getCountPlural: function getCountPlural() {
      return this.get('countText').plural;
    },
    getCountSingular: function getCountSingular() {
      return this.get('countText').singular;
    },
    getLinks: function getLinks() {
      return this.get('links');
    },
    getCarts: function getCarts() {
      return this.get('carts').filter(function (cart) {
        return cart.order_items.length > 0;
      });
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.cartFlyout.CartBlockView = Backbone.View.extend({
    initialize: function initialize() {
      this.listenTo(this.model, 'cartsLoaded', this.render);
    },

    events: {
      'click .cart-block--link__expand': 'offcanvasOpen'
    },
    offcanvasOpen: function offcanvasOpen(event) {
      event.preventDefault();

      if (this.model.getCount() > 0) {
        Drupal.cartFlyout.flyoutOffcanvasToggle();
      }
    },
    render: function render() {
      var template = Drupal.cartFlyout.getTemplate({
        id: 'commerce_cart_flyout_block',
        data: this.model.attributes.templates.block
      });
      this.$el.html(template.render({
        url: this.model.getUrl(),
        count_text: Drupal.formatPlural(this.model.getCount(), this.model.getCountSingular(), this.model.getCountPlural())
      }));
      var icon = new Drupal.cartFlyout.CartIconView({
        el: this.$el.find('.cart-block--summary__icon'),
        model: this.model
      });
      icon.render();

      Drupal.attachBehaviors();
    }
  });
  Drupal.cartFlyout.CartIconView = Backbone.View.extend({
    render: function render() {
      var template = Drupal.cartFlyout.getTemplate({
        id: 'commerce_cart_js_block_icon',
        data: this.model.attributes.templates.icon
      });
      this.$el.html(template.render({
        icon: this.model.getIcon()
      }));
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Backbone, Drupal) {
  Drupal.cartFlyout.CartOffcanvasView = Backbone.View.extend({
    initialize: function initialize() {
      this.listenTo(this.model, 'cartsLoaded', this.render);
    },

    events: {
      'click .cart-block--offcanvas-cart-table__remove button': 'removeItem',
      'click .cart--cart-offcanvas__close button': 'closeOffCanvas'
    },
    closeOffCanvas: function closeOffCanvas() {
      Drupal.cartFlyout.flyoutOffcanvasToggle();
    },
    removeItem: function removeItem(e) {
      e.preventDefault();
      var target = JSON.parse(e.currentTarget.value);
      var endpoint = Drupal.url('cart/' + target[0] + '/items/' + target[1] + '?_format=json');
      $.ajax({
        url: endpoint,
        method: 'DELETE'
      }).done(function () {
        return Drupal.cartFlyout.fetchCarts();
      });
    },
    render: function render() {
      var template = Drupal.cartFlyout.getTemplate({
        id: 'commerce_cart_flyout_offcanvas',
        data: Drupal.cartFlyout.templates.offcanvas
      });
      this.$el.html(template.render({
        count: this.model.getCount(),
        links: this.model.getLinks()
      }));
      var contents = new Drupal.cartFlyout.CartContentsView({
        el: this.$el.find('.cart-block--offcanvas-contents__items'),
        model: this.model
      });
      contents.render();
    }
  });
  Drupal.cartFlyout.CartContentsView = Backbone.View.extend({
    render: function render() {
      var carts = this.model.getCarts();
      var template = Drupal.cartFlyout.getTemplate({
        id: 'commerce_cart_flyout_offcanvas_contents',
        data: Drupal.cartFlyout.templates.offcanvas_contents
      });
      this.$el.html(template.render({
        carts: carts
      }));

      this.$el.find('[data-cart-contents]').each(function (k) {

        var contents = new Drupal.cartFlyout.CartContentsItemsView({
          el: this,
          model: carts[k]
        });
        contents.render();
      });
    }
  });
  Drupal.cartFlyout.CartContentsItemsView = Backbone.View.extend({
    events: {
      'change .cart-block--offcanvas-cart-table__quantity input[type="number"]': 'onQuantityChange',
      'blur .cart-block--offcanvas-cart-table__quantity input[type="number"]': 'doUpdateCart',
      'keypress .cart-block--offcanvas-cart-table__quantity input[type="number"]': 'onKeypress',
      'click .cart-block--offcanvas-contents__update': 'onUpdateCart'
    },
    onQuantityChange: function onQuantityChange(e) {
      var targetDelta = e.target.dataset.key;
      var value = e.target.value >= 1 ? e.target.value : "1.00";
      this.model.order_items[targetDelta].quantity = parseInt(value);
    },
    onUpdateCart: function onUpdateCart(event) {
      event.preventDefault();
      this.doUpdateCart();
    },
    onKeypress: function onKeypress(event) {
      if (event.keyCode === 13) {
        event.target.blur();
        event.preventDefault();
      }
    },
    doUpdateCart: function doUpdateCart() {
      var endpoint = Drupal.url('cart/' + this.model.order_id + '/items?_format=json');

      var body = {};
      for (var index = 0; index < this.model.order_items.length; index++) {
        var orderItem = this.model.order_items[index];
        body[orderItem.order_item_id] = {
          quantity: orderItem.quantity
        };
      }

      $.ajax({
        url: endpoint,
        method: 'PATCH',
        data: JSON.stringify(body),
        contentType: 'application/json;',
        dataType: 'json'
      }).done(function () {
        return Drupal.cartFlyout.fetchCarts();
      });
    },
    render: function render() {
      var template = Drupal.cartFlyout.getTemplate({
        id: 'commerce_cart_flyout_offcanvas_contents_items',
        data: Drupal.cartFlyout.templates.offcanvas_contents_items
      });
      this.$el.html(template.render({
        cart: this.model
      }));
    }
  });
})(jQuery, Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, _, Drupal, drupalSettings) {
  Drupal.theme.addToCartButton = function () {
    return drupalSettings.theme.commerce_cart_flyout_add_to_cart_button;
  };
  Drupal.theme.addToCartAttributesSelect = function (_) {
    return function (args) {
      var template = _.template(drupalSettings.theme.commerce_cart_flyout_add_to_cart_attributes_select);
      return template(args);
    };
  }(_);
  Drupal.theme.addToCartAttributesRadios = function (_) {
    return function (args) {
      var template = _.template(drupalSettings.theme.commerce_cart_flyout_add_to_cart_attributes_radios);
      return template(args);
    };
  }(_);
  Drupal.theme.addToCartAttributesRendered = function (_) {
    return function (args) {
      var template = _.template(drupalSettings.theme.commerce_cart_flyout_add_to_cart_attributes_rendered);
      return template(args);
    };
  }(_);
  Drupal.theme.addToCartVariationSelect = function (_) {
    return function (args) {
      var template = _.template(drupalSettings.theme.commerce_cart_flyout_add_to_cart_variation_select);
      return template(args);
    };
  }(_);

  Drupal.addToCart = {};
  Drupal.behaviors.addToCart = {
    attach: function attach(context) {
      $(context).find('[data-product]').once('flyout-add-to-cart').each(function (k, el) {
        var model = new Drupal.addToCart.AddToCartModel(drupalSettings.addToCart[el.dataset.product]);
        new Drupal.addToCart.AddToCartView({ el: el, model: model });
      });
    }
  };
})(jQuery, _, Drupal, drupalSettings);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function (Backbone, Drupal) {
  Drupal.addToCart.AddToCartModel = Backbone.Model.extend({
    defaults: {
      defaultVariation: '',
      selectedVariation: '',
      attributes: {},
      renderedAttributes: {},
      injectedFields: {},
      variations: {},
      variationCount: 0,
      type: 'commerce_product_variation_attributes'
    },
    initialize: function initialize() {
      this.set('variationCount', Object.keys(this.get('variations')).length);
      this.set('selectedVariation', this.getVariation(this.get('defaultVariation')));
    },
    getDefaultVariation: function getDefaultVariation() {
      return this.get('defaultVariation');
    },
    getAttributes: function getAttributes() {
      return this.get('attributes');
    },
    getVariations: function getVariations() {
      return this.get('variations');
    },
    getVariation: function getVariation(uuid) {
      return this.attributes['variations'][uuid];
    },
    getResolvedVariation: function getResolvedVariation(selectedAttributes) {
      var _this = this;

      return Object.keys(this.getVariations()).map(function (key) {
        return _this.getVariation(key);
      }).filter(function (variation) {
        return _this.getAttributes().every(function (attribute) {
          var fieldName = 'attribute_' + attribute.id;
          return variation.hasOwnProperty(fieldName) && variation[fieldName].toString() === selectedAttributes[fieldName].toString();
        });
      }).shift();
    },
    getSelectedVariation: function getSelectedVariation() {
      return this.attributes['selectedVariation'];
    },
    setSelectedVariation: function setSelectedVariation(uuid) {
      this.set('selectedVariation', this.getVariation(uuid));
    },
    getVariationCount: function getVariationCount() {
      return this.get('variationCount');
    },
    getRenderedAttribute: function getRenderedAttribute(fieldName) {
      return this.attributes['renderedAttributes'][fieldName];
    },
    getInjectedFieldsForVariation: function getInjectedFieldsForVariation(uuid) {
      return this.attributes['injectedFields'][uuid];
    },
    getType: function getType() {
      return this.attributes['type'];
    }
  });
})(Backbone, Drupal);;
/**
* DO NOT EDIT THIS FILE.
* See the following change record for more information,
* https://www.drupal.org/node/2815083
* @preserve
**/

(function ($, Backbone, _, Drupal) {
  Drupal.addToCart.AddToCartView = Backbone.View.extend({
    initialize: function initialize() {
      var _this = this;

      var defaultVariation = this.model.getVariation(this.model.getDefaultVariation());
      _.each(this.model.getAttributes(), function (attribute, i) {
        var attributeFieldName = 'attribute_' + attribute.id;
        if (defaultVariation.hasOwnProperty(attributeFieldName)) {
          _this.selectedAttributes[attributeFieldName] = defaultVariation[attributeFieldName];
        }
      });
      this.render();
    },

    events: {
      'click .form-submit': 'addToCart',
      'change .attribute-widgets input[type="radio"]': 'onAttributeChange',
      'change .attribute-widgets select': 'onAttributeChange',
      'change .variations-select select': 'onVariationTitleChange'
    },
    onVariationTitleChange: function onVariationTitleChange(event) {
      Drupal.detachBehaviors();
      var selectedVariation = this.model.getVariation(event.target.value);
      this.model.setSelectedVariation(selectedVariation.uuid);
      var injectedFields = this.model.getInjectedFieldsForVariation(selectedVariation.uuid);
      Object.values(injectedFields).map(function (injectedField) {
        $('.' + injectedField.class).html(injectedField.output);
      });
      Drupal.attachBehaviors();
    },
    onAttributeChange: function onAttributeChange(event) {
      Drupal.detachBehaviors();
      this.selectedAttributes[event.target.name] = event.target.value;
      var selectedVariation = this.model.getResolvedVariation(this.selectedAttributes);
      this.model.setSelectedVariation(selectedVariation.uuid);
      var injectedFields = this.model.getInjectedFieldsForVariation(selectedVariation.uuid);
      Object.values(injectedFields).map(function (injectedField) {
        $('.' + injectedField.class).html(injectedField.output);
      });
      Drupal.attachBehaviors();
    },
    addToCart: function addToCart() {
      var selectedVariation = this.model.getSelectedVariation();
      $.ajax({
        url: Drupal.url('cart/add?_format=json'),
        method: 'POST',
        data: JSON.stringify([{
          purchased_entity_type: 'commerce_product_variation',
          purchased_entity_id: selectedVariation.variation_id,
          quantity: 1
        }]),
        contentType: 'application/json;',
        dataType: 'json'
      }).done(function () {
        Drupal.cartFlyout.fetchCarts();
        Drupal.cartFlyout.flyoutOffcanvasToggle();
      });
    },
    render: function render() {
      if (this.model.getVariationCount() === 1) {
        this.$el.html(Drupal.theme('addToCartButton'));
      } else if (this.model.getAttributes().length === 0 || this.model.getType() !== 'commerce_product_variation_attributes') {
        var html = ['<div class="variations-select form-group">'];

        var variations = this.model.getVariations();
        html.push(Drupal.theme('addToCartVariationSelect', {
          variations: Object.keys(variations).map(function (uuid) {
            return variations[uuid];
          })
        }));

        html.push('</div>');
        html.push(Drupal.theme('addToCartButton'));
        this.$el.html(html.join(''));
      } else {
        var view = this;
        var _html = ['<div class="attribute-widgets form-group">'];
        this.model.getAttributes().forEach(function (entry) {
          var defaultArgs = {
            label: entry.label,
            attributeId: entry.id,
            attributeValues: entry.values,
            activeValue: view.selectedAttributes['attribute_' + entry.id]
          };

          if (entry.element_type === 'select') {
            _html.push(Drupal.theme('addToCartAttributesSelect', defaultArgs));
          } else if (entry.element_type === 'radios') {
            _html.push(Drupal.theme('addToCartAttributesRadios', defaultArgs));
          } else if (entry.element_type === 'commerce_product_rendered_attribute') {
            _html.push(Drupal.theme('addToCartAttributesRendered', Object.assign({}, defaultArgs, {
              attributeValues: view.model.getRenderedAttribute('attribute_' + entry.id)
            })));
          }
        });
        _html.push('</div>');
        _html.push(Drupal.theme('addToCartButton'));
        this.$el.html(_html.join(''));
      }
    }
  });
  Drupal.addToCart.AddToCartView.prototype.selectedAttributes = {};
})(jQuery, Backbone, _, Drupal);;
