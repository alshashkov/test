$(function() {
	var $tasksList = $("#list");
	var $taskInput = $("#input-name");
	var $notification = $("#case-comment");
	var $descCreate = $("#desc-create")


	var displayNotification = function() {
		if (!$tasksList.children().length) {
			$notification.fadeIn("1000")
		}
		else {
			$notification.css("display", "none")
		}
	}

    $("#button").on("click" , function(){
    	if(!$taskInput.val()) {return false;}
        
        $tasksList.append("<div class='out_div'><div class='desc-name'>" + $taskInput.val() + "<div class='opisanie'>" + $descCreate.val() + "</div></div>"
            +  "<button class='delete'><img src='del.png'></button>" + "<button class='hide-show'><img src='arrow-hide.png'></button>"
            ); 


        $(".delete").on("click", function() {
        	var $parent = $(this).parent();


        	$parent.css("animation", "fadeOut .7s linear");

        	setTimeout(function() {
        		$parent.remove(); 
        		displayNotification();
        	}, 500)
        });


        $(".hide-show").on("click", function() {
		var aaaa=$(this).parent().children().first().children().first();
        
                    if ((aaaa).is(':visible')) {
                        aaaa.fadeOut(1000);
                    } else {
                        aaaa.fadeIn(1000);
                    }
        
                });


//        $('.hide-show').click(function(){
//        if ($('.opisanie').is(':visible')) {
//            $('.opisanie').hide();
//        } else {
//            $('.opisanie').show();
//        }
//        })

    })
});

                 