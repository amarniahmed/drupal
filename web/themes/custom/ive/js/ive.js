(function($, Drupal, drupalSettings){
    $(document).ready(function(){
       // alert('hello!');
        $("a[href^='http']").attr('target','_blank');
        //$("a[href^='http']").attr('target','_blank');
       // $("a[href^='http']").prepend.src=("external-link.gif");
        var $host = window.location.origin;
        $("a[href^='http']").prepend('<img src="'+$host+'/d8composer/web/themes/custom/ive/images/external-link.gif" />');
        //$(".node a[href^='http']").prepend (<img src='/themes/custom/ive/images/external-link.gif'>;
        //$("h2 [block-ive-search]").slideToggle(vitesse,callback);
        $('.block h2').click(function(){
            $(this).parent().find('.content').slideToggle();
        });

   });
})(jQuery, Drupal, drupalSettings);

