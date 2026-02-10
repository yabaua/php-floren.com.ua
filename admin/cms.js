function GetClipboardHTML()
{
	var oDiv = document.getElementById("divTemp")
	oDiv.innerHTML = "";
	
	var oTextRange = document.body.createTextRange() ;
	oTextRange.moveToElementText(oDiv) ;
	oTextRange.execCommand("Paste") ;
	
	var sData = oDiv.innerHTML ;
	oDiv.innerHTML = "" ;
	
	return sData ;
}
function cmsBeforePaste() {
		cleanAndPaste(GetClipboardHTML());
		clipboardData.clearData();
//	window.clipboardData.setData("Text", window.clipboardData.getData("Text"));
}
function cleanAndPaste(html)
{
	// Remove all SPAN tags
	html = html.replace(/<\/?SPAN[^>]*>/gi, "" );
	// Remove Class attributes
	html = html.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3") ;
	// Remove Style attributes
	html = html.replace(/<(\w[^>]*) style="([^"]*)"([^>]*)/gi, "<$1$3") ;
	// Remove Lang attributes
	html = html.replace(/<(\w[^>]*) lang=([^ |>]*)([^>]*)/gi, "<$1$3") ;
	
	// Remove XML elements and declarations
	html = html.replace(/<\\?\?xml[^>]*>/gi, "") ;
	// Remove Tags with XML namespace declarations: <o:p></o:p>
	html = html.replace(/<\/?\w+:[^>]*>/gi, "") ;
	// Replace the &nbsp;
	html = html.replace(/&nbsp;/, " " );
	// Transform <P> to <DIV>
	//var re = new RegExp("(<P)([^>]*>.*?)(<\/P>)","gi") ;	// Different because of a IE 5.0 error
	//html = html.replace( re, "<div$2</div>" ) ;
		
	if (document.selection.type.toLowerCase() != "none")
		document.selection.clear() ;
	document.selection.createRange().pasteHTML(html);
	
	//"
}
