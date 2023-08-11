<!-- JAVASCRIPT -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/jquery/jquery.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/node-waves/waves.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="{{URL::to('/')}}/templates/dashboard/assets/js/pages/dashboard.init.js"></script>

<script src="{{URL::to('/')}}/templates/dashboard/assets/js/app.js"></script>

<!-- Select2 -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/select2/js/select2.min.js"></script>

<!-- Sweetalert2 -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(function() {
        if ($('.select2').length >= 1) {
            $('.select2').select2({
                width : "100%",
                allowClear: true,
            });
        }
    });

    function openLoader(){
        $('#preloader').css("display","block");
        $('#preloader').find("#status").css("display","block");
    }

    function closeLoader(){
        $('#preloader').css("display","none");
        $('#preloader').find("#status").css("display","none");
    }

    function responseSuccess(message, callback = null) {
	    Swal.fire({
	        type: 'success',
	        title: 'success',
	        html: message,
            timer : 5000,
	    }).then((ok) => {
	        if (callback != null) {
	            return location.href = callback
	        }
	    })
	}

	function responseFailed(message) {
	    Swal.fire({
	        type: 'error',
	        title: 'Oops...',
	        html: message,
            timer : 5000,
	    })
	}

	function responseInternalServerError() {
	    Swal.fire({
	        type: 'error',
	        title: 'Oops...',
	        html: 'Internal server error',
            timer : 5000,
	    })
	}

	function getProvince(selector,selectedId=null){
        $.ajax({
            url : '{{route("base.indonesia.province")}}',
            method : "GET",
            dataType : "JSON",
            beforeSend : function(){
                return openLoader();
            },
            success : function(resp){
                if(resp.success == false){
                    responseFailed(resp.message);       
                    $(selector+'').html("");            
                }
                else{
                    let html = "";
                    $.each(resp.data,function(index,element){
                        if(selectedId != null && element.code == selectedId){
                            html += '<option value="'+element.code+'" selected>'+element.name+'</option>';
                        }
                        else{
                            html += '<option value="'+element.code+'">'+element.name+'</option>';
                        }
                    });
                    $(selector+'').append(html);
                }
            },
            error: function (request, status, error) {
                if(request.status == 422){
                    responseFailed(request.responseJSON.message);
                }
                else{
                    responseInternalServerError();
                }
            },
            complete :function(){
                return closeLoader();
            }
        })
    }

    function getCity(selector,province_code,selectedId=null){
        $.ajax({
            url : '{{route("base.indonesia.city")}}',
            method : "GET",
            data : {
                province_code : province_code
            },
            dataType : "JSON",
            beforeSend : function(){
                return openLoader();
            },
            success : function(resp){
                if(resp.success == false){
                    responseFailed(resp.message);       
                    $(selector+'').html("");            
                }
                else{
                    let html = "";
                    $.each(resp.data,function(index,element){
                        if(selectedId != null && element.code == selectedId){
                            html += '<option value="'+element.code+'" selected>'+element.name+'</option>';
                        }
                        else{
                            html += '<option value="'+element.code+'">'+element.name+'</option>';
                        }
                    });
                    $(selector+'').append(html);
                }
            },
            error: function (request, status, error) {
                if(request.status == 422){
                    responseFailed(request.responseJSON.message);
                }
                else{
                    responseInternalServerError();
                }
            },
            complete :function(){
                return closeLoader();
            }
        })
    }

    function getDistrict(selector,city_code,selectedId=null){
        $.ajax({
            url : '{{route("base.indonesia.district")}}',
            method : "GET",
            data : {
                city_code : city_code
            },
            dataType : "JSON",
            beforeSend : function(){
                return openLoader();
            },
            success : function(resp){
                if(resp.success == false){
                    responseFailed(resp.message);       
                    $(selector+'').html("");            
                }
                else{
                    let html = "";
                    $.each(resp.data,function(index,element){
                        if(selectedId != null && element.code == selectedId){
                            html += '<option value="'+element.code+'" selected>'+element.name+'</option>';
                        }
                        else{
                            html += '<option value="'+element.code+'">'+element.name+'</option>';
                        }
                    });
                    $(selector+'').append(html);
                }
            },
            error: function (request, status, error) {
                if(request.status == 422){
                    responseFailed(request.responseJSON.message);
                }
                else{
                    responseInternalServerError();
                }
            },
            complete :function(){
                return closeLoader();
            }
        })
    }

    function getVillage(selector,district_code,selectedId=null){
        $.ajax({
            url : '{{route("base.indonesia.village")}}',
            method : "GET",
            data : {
                district_code : district_code
            },
            dataType : "JSON",
            beforeSend : function(){
                return openLoader();
            },
            success : function(resp){
                if(resp.success == false){
                    responseFailed(resp.message);       
                    $(selector+'').html("");            
                }
                else{
                    let html = "";
                    $.each(resp.data,function(index,element){
                        if(selectedId != null && element.code == selectedId){
                            html += '<option value="'+element.code+'" selected>'+element.name+'</option>';
                        }
                        else{
                            html += '<option value="'+element.code+'">'+element.name+'</option>';
                        }
                    });
                    $(selector+'').append(html);
                }
            },
            error: function (request, status, error) {
                if(request.status == 422){
                    responseFailed(request.responseJSON.message);
                }
                else{
                    responseInternalServerError();
                }
            },
            complete :function(){
                return closeLoader();
            }
        })
    }
</script>
@yield("script")