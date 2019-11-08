/*
 * Cuando escribí esto sólo Dios y yo sabíamos lo que hace.
 * Ahora, sólo Dios sabe.
 * Lo siento.
 */



function new_captcha(){
	$('.captcha').attr("src",img_url_loader);
    $('.captcha').attr("src",site_url+ '/inicio/captcha/' + Math.random());
}
