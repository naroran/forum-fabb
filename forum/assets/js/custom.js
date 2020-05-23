
$(document).ready(function(){
  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
});

function addBalises(idTextarea, baliseOpen, baliseClose)
{
 	// Si il y a deux balises BBCode (ouvrante et fermante)
  	if (baliseClose != null) {
		// Si il n'y a aucune sélection dans le texte
 		if ($(idTextarea).prop('selectionStart') == $(idTextarea).prop('selectionEnd')) {
			var textBefore = getTextBeforeCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'));
			var textAfter = getTextAfterCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'), $(idTextarea).val().length);
			$(idTextarea).val(textBefore+baliseOpen+baliseClose+textAfter);
		// Si un du texte a été sélectionné
		} else {
			var textBefore = getTextBeforeCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'));
			var textAfter = getTextAfterCursor($(idTextarea).val(), $(idTextarea).prop('selectionEnd'), $(idTextarea).val().length);
			var textSelection = getTextSelectionCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'), $(idTextarea).prop('selectionEnd'));
			$(idTextarea).val(textBefore+baliseOpen+textSelection+baliseClose+textAfter);
		}
	// Si il n'y a qu'une balise BBCode (ouvrante ou fermante)
	} else {
		var textBefore = getTextBeforeCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'));
		var textAfter = getTextAfterCursor($(idTextarea).val(), $(idTextarea).prop('selectionStart'), $(idTextarea).val().length);		
		$(idTextarea).val(textBefore+baliseOpen+textAfter);
	}
}

/**
 * Sélection du texte présent avant la sélection du curseur
 *
 * @param <string> Texte
 * @param <integer> Position du curseur
 */
function getTextBeforeCursor(text, value)
{
	var textBefore = '';
	for (var i = 0 ; i < value ; i++) {
		textBefore += text[i];
	}
	return textBefore;
}

/**
 * Sélection du texte présent après la sélection du curseur
 *
 * @param <string> Texte
 * @param <integer> Position du curseur
 * @param <integer> Nombre de caractères du texte
 */
function getTextAfterCursor(text, value, textSize)
{
	var textAfter = '';
	for (var i = value ; i < textSize ; i++) {
		textAfter += text[i];
	}
	return textAfter;
}

/**
 * Sélection du texte présent dans la sélection du curseur
 *
 * @param <string> Texte
 * @param <integer> Position du curseur au début de la sélection
 * @param <integer> Position du curseur à la fin de la sélection
 */
function getTextSelectionCursor(text, startValue, endValue)
{
	var textSelection = '';
	for (var i = startValue ; i < endValue ; i++) {
		textSelection += text[i];
	}
	return textSelection;
}