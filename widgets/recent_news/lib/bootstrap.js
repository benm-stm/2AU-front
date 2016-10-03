$(document).ready(function() {
 $.ajax({
                url: 'widgets/recent_news/main.php',
                data: "",
                type: 'POST',
                success: function(recent_news) {
                        $("#recent_news").append(recent_news);
                }
        });
});

