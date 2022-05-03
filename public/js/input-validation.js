$(".only-numeric").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      });


$(".only-numeric-decimal").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57) && keyCode!=46) 
          {
          	//alert("If part");
            $(".error").css("display", "inline");
            return false;
          }else{
          	//alert("Else part");
            $(".error").css("display", "none");
            if(keyCode == 46)
            {
            	if ($(this).val().replace(/[^.]/g, "").length > 0)
            	{
    				return false; 
  				}
            }
          }
      });