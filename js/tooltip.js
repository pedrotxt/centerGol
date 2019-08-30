$(document).ready(function() {
        // Tooltip only Text
        $('.tip').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .html(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 10; //Get X coordinates
                var mousey = e.pageY + 1; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });

        
        $('.tip2').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .html(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 10; //Get X coordinates
                var mousey = e.pageY + 20; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });


});