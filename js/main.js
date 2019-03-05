jQuery(function($) {

    jQuery('#manufacture-select').on('change', function(){
        var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('year-id');
            }).get(); 

        var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var manufacture = jQuery(this).find('option:selected').data('manufacture-id');
       
        var minprice = jQuery("input[name='cena_min']").val();
      
        var maxprice = jQuery("input[name='cena_max']").val();
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                 },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery('.white-projects .filter-year input').on('click', function(e){
        var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('year-id');
            }).get();
        var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var minprice = jQuery("input[name='cena_min']").val();
      
        var maxprice = jQuery("input[name='cena_max']").val();
                            
        var manufacture = jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                  },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery('.white-projects .filter-screen input').on('click', function(e){
        var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('year-id');
            }).get();
        var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
       
        var minprice = jQuery("input[name='cena_min']").val();
      
        var maxprice = jQuery("input[name='cena_max']").val();
                            
        var manufacture = jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones',
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                  },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery('.white-projects .filter-ram input').on('click', function(e){
        var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
       var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var minprice = jQuery("input[name='cena_min']").val();
      
        var maxprice = jQuery("input[name='cena_max']").val();
                            
        var manufacture = jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                  },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery('.white-projects .filter-processor input').on('click', function(e){
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
       var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
       var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var minprice = jQuery("input[name='cena_min']").val();
      
        var maxprice = jQuery("input[name='cena_max']").val();
                            
        var manufacture = jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice
                },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery("input#min").keyup(function() {
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
       var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
       var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var minprice = jQuery("input#min").val();
        var maxprice = jQuery("input#max").val();
        var manufacture =  jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
                jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                 },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery("input#max").keyup(function() {
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
       var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
       var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var maxprice = jQuery("input#max").val();
        var minprice = jQuery("input#min").val();
        var manufacture =  jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id	 : ram,
                    cena_max : maxprice,
                    cena_min : minprice

                  },
                success: function (data) {
                    if (data[0].hasOwnProperty("error")) {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-error'),data);
                    } else {
                        jQuery('#ajax-portfolio-container').loadTemplate(jQuery('#project-block'),data);
                    }
                 }
            });
        },1000);
    });

    jQuery('body').on('click','#load-more-events', function(e){
        e.preventDefault();
       var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
       var ram = jQuery('.white-projects .filter-ram input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
       var year = jQuery('.white-projects .filter-year input:checked').map(function()
            {
                return jQuery(this).data('ram-id');
            }).get();
        var processor = jQuery('.white-projects .filter-processor input:checked').map(function()
            {
                return jQuery(this).data('processor-id');
            }).get();
        var screen = jQuery('.white-projects .filter-screen input:checked').map(function()
            {
                return jQuery(this).data('screen-id');
            }).get();
        var manufacture =  jQuery("#manufacture-select").find('option:selected').data('manufacture-id');
        var maxprice = jQuery("input#max").val();
        var minprice = jQuery("input#min").val();
        var page = jQuery(this).data('page');
        var button = jQuery(this);
        jQuery('.modal').show();
        setTimeout(function() {
            jQuery('.modal').hide();
            $.ajax({
                type: "POST",
                url: window.wp_data.ajax_url,
                dataType: 'json',
                data : {
                    action : 'get_smartphones', 
                    manufacture_id : manufacture, 
                    year_id : year,
                    screen_id: screen,
                    processor_id: processor,
                    ram_id   : ram,
                    cena_max : maxprice,
                    cena_min : minprice,
                    paged : page
                },
                success: function (data) {
                    button.remove();
                   jQuery('<div class="paginate">').loadTemplate(jQuery("#project-block"), data).appendTo("#ajax-portfolio-container");
                }
            });
        },1000);
    });
});


 


 

 
