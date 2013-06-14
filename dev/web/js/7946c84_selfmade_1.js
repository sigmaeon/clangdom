$(function() {
//Tabs
			$("#tabs").tabs();
//Dialog in Content
			$(".dialog-multiselect").chosen();
//Accordion Content
			$("#accordion").accordion({
				heightStyle: "content",
				collapsible:true,
				active: false,
			});
// Message Dialog			
			 $("#open_m").on("click", function(e) {
                $("#dialog_m").dialog({
                    draggable:false,
                    resizable: false,
                    modal: true,
                    width: 500,
                    height: 420,
					buttons:{
					"Send message": function(){
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
						}
					}

                });
                
                $(".inner-dialog-multiselect").chosen();
				
            });
//Music Upload Dialog	
			$("#open_mu").on("click", function(e) {
                $("#dialog_mu").dialog({
                    draggable:false,
                    resizable: false,
                    modal: true,
                    width: 500,
                    height: 200,
					buttons:{
					"Upload": function(){
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
						}
					}

                });
                
            });
//Videoupload Dialog
			$("#open_vu").on("click", function(e) {
                $("#dialog_vu").dialog({
                    draggable:false,
                    resizable: false,
                    modal: true,
                    width: 500,
                    height: 200,
					buttons:{
					"Upload": function(){
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
						}
					}

                });
                
            })
				
			
			
        });