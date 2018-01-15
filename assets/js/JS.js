$(document).ready(function() {
    $(function() {
        var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

        $("ul a li").each(function(){
            if($(this).attr("href") == pgurl || $(this).attr("href") == '' || $(this).attr("href")+"#" == pgurl)
            $(this).addClass("urlActual");
         })
    });
    $('.modal-trigger').leanModal();// INICIAR LOS MODALES
} );//Fin Document ready



