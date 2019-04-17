$(document).ready(function(){
    get_units();
    //display_students();
    $("#login").click(function(event){
        event.preventDefault();
        var regno= $("#regno").val();
        var pass = $("#password").val();
        $.ajax({
            url :"login.php",
            method :"POST",
            data :{userLogin:1,userRegno:regno,userPassword:pass},
            success : function(data){
                window.location.href="profile.php";
            }
               
        })
    })
    $("#loginl").click(function(event){
        event.preventDefault();
        var email= $("#emaill").val();
        var pass = $("#passwordl").val();
        $.ajax({
            url :"loginl.php",
            method :"POST",
            data :{lecLogina:1,userEmail:email,userPasswordl:pass},
            success : function(data){
                window.location.href="profilel.php";
            }
               
        })
    })
    $("#loginc").click(function(event){
        event.preventDefault();
        var email= $("#emailc").val();
        var pass = $("#passwordc").val();
        $.ajax({
            url :"loginc.php",
            method :"POST",
            data :{codLogin:1,codEmail:email,codPassword:pass},
            success : function(data){
                window.location.href="codprofile.php";
            }
               
        })
    })
    // --------captures data from units assignment form and sends to action.php
    // --------if successful it alerts

    $("#unit").click(function(event){
        event.preventDefault();
        var code= $("#u_code").val();
        var name = $("#u_name").val();
        var group = $("#group1").val();
        var lec_reg = $("#lec_reg").val();
        $.ajax({

            url    :"action.php",
            method :"POST",
            data   :{unit_assignment:1,codeCode:code,codeName:name,
                codeGroup1:group,codeLec:lec_reg},
            success:function(data){
                $("#unit_msg").html(data);
                get_units();
            }
        })
    })
    // ---------ajax function retrieves data of units assigned

    get_units();
    function get_units(){
        $.ajax({
            url:'action.php',
            method :'POST',
            data :{get_units:1},
            success:function(data){
                $("#unit_check").html(data);
            }
        })
    }
    // ---------ajax function removes the selected unit assigned

    $("body").delegate(".remove","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("remove_id");
		$.ajax({
			url : "action.php",
			method : "POST",
			data : {removeFromDepartment:1,removeId:pid},
			success : function(data){
				$("#delete_msg").html(data);
                get_units();
		    }
		})
		
    })
    // ---------ajax displays results assignment form

    $("#displayform").click(function(event){
        event.preventDefault();
        var academic_yr=$('#academic_yr').find(":selected").text();
        var semester=$('#sem').find(":selected").text();
        $.ajax({
            url    :"action.php",
            method :"POST",
            data   :{displayForm:1,checkYr:academic_yr,checkSem:semester},
            success:function(data){
                $("#confirm_detail").hide();
                $("#displaystudents").html(data);

            }
        })
    })
    
    // ---------ajax function insert units assigned

    $("body").delegate(".update","click",function(event){
		event.preventDefault();
		var pid = $(this).attr("update_id");
		var sid = $(this).attr("s_id");
        var assign1 =$("#assign1-"+sid).val();
		var assign2 =$("#assign2-"+sid).val();
		var cat1 = $("#cat1-"+sid).val();
		var cat2 = $("#cat2-"+sid).val(); 
		var exam = $("#exam-"+sid).val();
		var aggr = $("#aggr-"+sid).val();
        $.ajax({
			url : "action.php",
			method : "POST",
			data : {updateResults:1,updateId:pid,reg:sid,assign1:assign1,assign2:assign2,cat1:cat1,cat2:cat2,exam:exam,aggr:aggr,aggr:aggr},
			success : function(data){
				$("#update_msg").html(data);
		    }
		})
		event.preventDefault();
		
    })

    $("#search_btn").click(function(event){
        
        var keyword = $("#search").val();
        if(keyword !=""){
        $.ajax({
           url    : "action.php",
           method : "POST",
           data   : {search:1,keyword:keyword},
           success: function(data){
               $("#get_results").html(data);
           }
       })
    }	event.preventDefault();
}) 
$("#request_btn").click(function(event){
    event.preventDefault();
    $.ajax({
       url    : "action.php",
       method : "POST",
       data   : {results:1},
       success: function(data){
           $("#view_results").html(data);
       }
   })

}) 

})
