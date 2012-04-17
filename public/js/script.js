jQuery.fn.rdy = function(func){
  this.length && func.apply(this);
  return this;
};
jQuery(document).ready(function($){
  $('html').removeClass('no-js');
  enablePlaceholderSupport();

});

function enablePlaceholderSupport(wrap){
  var $ = jQuery,
      wrap = wrap || 'body',
      fakeInput = document.createElement("input"),
      placeHolderSupport = ("placeholder" in fakeInput),
      clearValue = function (e) { if ($(e).val() === $(e).data('placeholder')) { $(e).val(''); } };

  if (!placeHolderSupport) {
    $('input[placeholder]', wrap).each(function(){

      var searchField = $(this),
          originalText = searchField.attr('placeholder'),
          val = $.trim(this.value);
      if(typeof searchField.data('placeholder') !== 'undefined') { return; }

      searchField.data('placeholder', originalText);
      if(val == '') { $(this).val(originalText).addClass("placeholder"); }

      searchField.bind("focus.ntz_placeholder", function () { if(this.value == $(this).data('placeholder')){ $(this).val('').removeClass('placeholder'); } }).bind("blur.ntz_placeholder", function () {
        if (this.value.length === 0) {
          $(this).val(originalText).addClass("placeholder");
        }
      });
    });

    $("form").bind("submit.ntz_placeholder", function () { $('input[placeholder]', this).each(function(){ clearValue(this); }); });

    $(window).bind("unload.ntz_placeholder", function () { clearValue($('input[placeholder]', this)); });
  }
}; // enablePlaceholderSupport

