@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@push('style')
@endpush
@section('title', 'chairman Create')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
<style type="text/css">
 .box{
    width:600px;
    margin:0 auto;
}
.droplist{
    padding: 0 10px;
}
.titleheading{
    width: 18%;
}
.colon{
    width: 2%;
}
.wordno{
    width: 10%;
}
.inputfield{

}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chairman Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('people.index') }}">Chairman</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info">
                    <div class="card-header">

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="peoplePersonalForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row h3">
                                এসাইন নতুন পর্ষদ 
                            </div>
                            <div class="row mt-5">
                                <table class="table table-bordered font-weight-bold">
                                    <tr>
                                        <td class="titleheading">বিভাগ</td>
                                        <td class="colon">:</td>
                                        <td class="inputfield">
                                            <select name="division_id" class="form-control select2" id="division_id">
                                             @if ($divisions)
                                             @foreach ($divisions as $division)
                                             <option value="{{$division->id}}">{{$division->name}}</option>
                                             @endforeach
                                             @endif
                                         </select>
                                     </td>
                                 </tr>
                                 <tr>
                                    <td class="titleheading">জেলা</td>
                                    <td class="colon">:</td>
                                    <td class="inputfield">
                                       <select class="form-control select2" name="district_id" id="district_id">
                                        <option value="">Select District</option>
                                        <option value="">No District Found</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="titleheading">থানা</td>
                                <td class="colon">:</td>
                                <td class="inputfield">
                                 <select  class="form-control select2" name="thana_id" id="thana_id">
                                    <option value="">Select Thana</option>
                                    <option value="">No Thana Found</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>ইউনিয়ন / পৌরসভা</td>
                            <td>:</td>
                            <td>
                                <select  class="form-control select2"  name="union_id" id="union_id">
                                    <option value="">Select Union</option>
                                    <option value="">No Union Found</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>মেয়াদ</td>
                            <td>:</td>
                            <td>
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="d-flex flex-row justify-content-between w-50">
                                        <div style="width: 15%;">Start Date</div>
                                        <div style="width: 100%;"> 
                                            <input type="date" name="start_date" class="form-control" >
                                        </div>
                                    </div> 
                                    <div class="d-flex flex-row justify-content-between w-50 ">
                                        <div style="width: 15%;margin-left: 20px;">End Date</div>
                                        <div style="width: 100%;">
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row mt-5">
                    <table class="table table-bordered font-weight-bold">
                        <tr>
                            <td class="titleheading">চেয়ারম্যান / মেয়র </td>
                            <td class="colon">:</td>
                            <td class="inputfield">
                                <select type="text" class="form-control select2" id="chairman_id" name="userinfo[]">
                                    <option>Please select chairman</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="row mt-5">
                    <table class="table table-bordered font-weight-bold">
                        <tr>
                            <td class="titleheading">সদস্য / কমিশনার </td>
                            <td class="colon">:</td>
                            <td class="wordno">ওয়ার্ড নং-১ </td>
                            <td class="inputfield"> 
                                <select class="form-control select2" name="userinfo[]" id="word_1_id">
                                    <option>Please Select</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>সদস্য / কমিশনার </td>
                            <td>:</td>
                            <td>ওয়ার্ড নং-২</td>
                            <td>
                                <select class="form-control select2" name="userinfo[]" id="word_2_id">
                                    <option>Please Select</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>সদস্য / কমিশনার </td>
                            <td>:</td>
                            <td>ওয়ার্ড নং-৩</td>
                            <td>
                                <select class="form-control select2" name="userinfo[]" id="word_3_id">
                                    <option>Please Select</option>
                                </select>
                            </td>
                        </tr> 
                        <tr>
                            <td>সদস্য / কমিশনার </td>
                            <td>:</td>
                            <td>ওয়ার্ড নং-৪</td>
                            <td>
                               <select class="form-control select2" name="userinfo[]" id="word_4_id">
                                <option>Please Select</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>সদস্য / কমিশনার </td>
                        <td>:</td>
                        <td>ওয়ার্ড নং-৫</td>
                        <td>
                          <select class="form-control select2" name="userinfo[]" id="word_5_id">
                            <option>Please Select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>সদস্য / কমিশনার </td>
                    <td>:</td>
                    <td>ওয়ার্ড নং-৬</td>
                    <td>
                        <select class="form-control select2" name="userinfo[]" id="word_6_id">
                            <option>Please Select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>সদস্য / কমিশনার </td>
                    <td>:</td>
                    <td>ওয়ার্ড নং-৭</td>
                    <td>
                       <select class="form-control select2" name="userinfo[]" id="word_7_id">
                        <option>Please Select</option>
                    </select>
                </td>
            </tr> 
            <tr>
                <td>সদস্য / কমিশনার </td>
                <td>:</td>
                <td>ওয়ার্ড নং-৮</td>
                <td>
                  <select class="form-control select2" name="userinfo[]" id="word_8_id">
                    <option>Please Select</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>সদস্য / কমিশনার </td>
            <td>:</td>
            <td>ওয়ার্ড নং-৯</td>
            <td>
              <select class="form-control select2" name="userinfo[]" id="word_9_id">
                <option>Please Select</option>
            </select>
        </td>
    </tr>
</table>
</div>


<div class="row mt-5">
    <table class="table table-bordered font-weight-bold">
        <tr>
            <td class="titleheading">সংরক্ষিত মহিলা সদস্য / কমিশনার</td>
            <td class="colon">:</td>
            <td class="wordno">ওয়ার্ড নং-১ (১,২,৩)</td>
            <td class="inputfield">
             
              <select class="form-control select2" name="userinfo[]" id="reserved_word_1_id">
                <option>Please Select</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>সংরক্ষিত মহিলা সদস্য / কমিশনার</td>
        <td>:</td>
        <td>ওয়ার্ড নং-২ (৪,৫,৬) </td>
        <td>
         <select class="form-control select2" name="userinfo[]" id="reserved_word_2_id">
            <option>Please Select</option>
        </select>
    </td>
</tr>
<tr>
    <td>সংরক্ষিত মহিলা সদস্য / কমিশনার</td>
    <td>:</td>
    <td>ওয়ার্ড নং-৩ (৭,৮,৯)</td>
    <td>
        <select class="form-control select2" name="userinfo[]" id="reserved_word_3_id">
            <option>Please Select</option>
        </select>
    </td>
</tr> 
</table>
</div>

<div class="row mt-5">
    <table class="table table-bordered font-weight-bold">
        <tr>
            <td class="titleheading">প্যানেল চেয়ারম্যান / মেয়র </td>
            <td class="colon">:</td>
            <td class="inputfield">
               <select class="form-control select2" name="userinfo[]" id="panel_chairman_id">
                <option>Please Select</option>
            </select>
        </td>
    </tr>
</table>
</div>
</div>
<!-- /.card-body -->
<div class="card-footer">
    <div class="form-group text-center">
        <a href="{{ route('chairman.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info ml-2">Save </button>
    </div>
</div>
<!-- /.card-footer -->
</form>
</div>
<!-- /.card -->
</div>
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->




@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.proto.js"></script>

<script type="text/javascript">


  $(document).ready(function () {
      $(".select2").chosen();
  });

</script>


<script>
    $(document).ready(function() {
        $("#peoplePersonalForm").on('submit', function(e) {
            
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('chairman.personalstore') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('.error').html('')
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        })
    })

    $(document).on('change', '#division_id', function(e){
        e.preventDefault();
        
        let district_id = $('#district_id');
        let division_id = $(this).val();
        if (division_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-districts-by-division') }}/"+division_id,
                beforeSend: function() {
                    // district_id.prop("disabled", true);
                    console.log("Searcing Districts");
                },
                success: function(response) {
                    // district_id.html(response)
                  $('#district_id').html(response);
                  $('#district_id').trigger("chosen:updated")
                    // district_id.prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    // district_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        } else {
            // district_id.prop("disabled", true);
        }
    })


    $(document).on('change', '#district_id', function(e){
        e.preventDefault();
        let district_id = $(this).val();
        let present_thana_id = $("#thana_id");

        

        if (district_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                beforeSend: function() {
                    // present_thana_id.prop("disabled", true);
                    console.log("Searcing Thana");
                },
                success: function(response) {
                    present_thana_id.html(response)
                    present_thana_id.trigger("chosen:updated")
                    // present_thana_id.prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    // present_thana_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }  
        else {
            // present_thana_id.prop("disabled", true);
        }
        
    })

    $(document).on('change', '#thana_id', function(e){
        e.preventDefault();
        let thana_id = $(this).val();
        let present_union_id = $('#union_id');
        if (thana_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-unions-by-thana') }}/"+thana_id,
                beforeSend: function() {
                    present_union_id.prop("disabled", true);
                    console.log("Searcing Unions");
                },
                success: function(response) {
                    present_union_id.prop("disabled", false);
                    present_union_id.html(response)
                    present_union_id.trigger("chosen:updated")
                },
                error: function(xhr, status, error) {
                    present_union_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        } else {
            present_union_id.prop("disabled", true);
        }
    })



    // $(document).on('change', '#union_id', function(e){
    //     e.preventDefault();
    //     let union_id = $(this).val();
    //     let ward_no = $('#ward_no');
    //     if (union_id) {
    //         $.ajax({
    //             type: "GET",

    //             url: "{{ url('/get-word-by-union') }}/"+union_id,
    //             beforeSend: function() {
    //                 ward_no.prop("disabled", true);
    //                 console.log("Searcing ward");
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 ward_no.html(response)
    //                 ward_no.prop("disabled", false);
    //                 // $("#ward_no").html(response);
    //             },
    //             error: function(xhr, status, error) {
    //                 ward_no.prop("disabled", true);
    //                 var responseText = jQuery.parseJSON(xhr.responseText);
    //                 toastr.error(responseText.message);
    //             }
    //         });
    //     } else {
    //         ward_no.prop("disabled", true);
    //     }

    // });


    $(document).on('change', '#union_id', function(e){
        e.preventDefault();
        let union_id = $(this).val();
        let ward_no = $('#chairman_id');
        if (union_id) {
            $.ajax({
                type: "GET",

                url: "{{ url('get-people-by-union') }}/"+union_id,
                beforeSend: function() {
                    ward_no.prop("disabled", true);
                    console.log("Searcing ward");
                },
                success: function(response) {
                      ward_no.prop("disabled", false);
                    // console.log(response);
                    ward_no.html(response)
                      ward_no.trigger("chosen:updated")
                    $('#word_1_id').html(response);
                    $('#word_1_id').trigger("chosen:updated")
                    
                    $('#word_2_id').html(response);
                    $('#word_2_id').trigger("chosen:updated")
                    
                    $('#word_3_id').html(response);
                    $('#word_3_id').trigger("chosen:updated")
                    
                    $('#word_4_id').html(response);
                    $('#word_4_id').trigger("chosen:updated")
                    
                    $('#word_5_id').html(response);
                    $('#word_5_id').trigger("chosen:updated")
                    
                    $('#word_6_id').html(response);
                    $('#word_6_id').trigger("chosen:updated")
                    
                    $('#word_7_id').html(response);
                    $('#word_7_id').trigger("chosen:updated")
                    
                    $('#word_8_id').html(response);
                    $('#word_8_id').trigger("chosen:updated")
                    
                    $('#word_9_id').html(response);
                    $('#word_9_id').trigger("chosen:updated")
                    
                    $('#reserved_word_1_id').html(response);
                    $('#reserved_word_1_id').trigger("chosen:updated")
                    
                    $('#reserved_word_2_id').html(response);
                    $('#reserved_word_2_id').trigger("chosen:updated")
                    
                    $('#reserved_word_3_id').html(response);
                    $('#reserved_word_3_id').trigger("chosen:updated")
                    
                    $('#panel_chairman_id').html(response);
                    $('#panel_chairman_id').trigger("chosen:updated")

                  
                    // $("#ward_no").html(response);
                },
                error: function(xhr, status, error) {
                    ward_no.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        } else {
            ward_no.prop("disabled", true);
        }

    });

    $('#citizen_id').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
           var _token = $('input[name="_token"]').val();
           $.ajax({
              url:"{{ route('chairman.fetch') }}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
                 $('#countryList').fadeIn();  
                 $('#countryList').html(data);
             }
         });
       }
   });

    $(document).on('click', 'li', function(){  
        $('#citizen_id').val($(this).text());  

        $('#citizen').val($(this).attr('id'));  
        $('#countryList').fadeOut();  
    });  

    $('#button').on('click',function(){
        let name =$('#citizen_id').val();
        let id =$('#citizen').val();
        let father="father";
        let type_id =$('#chairman_type_id option:selected').val();
        let type_text =$('#chairman_type_id option:selected').text();


        let str='';
        str +="<tr>\
        <td><input type='hidden' name='citizen_info[]' value='"+id+"'>"+name+"</td>\
        <td>"+father+"</td>\
        <td>NID</td>\
        <td><input type='hidden' name='position_info[]' value='"+type_id+"'>"+type_text+"</td>\
        <td><button type='button' class='btn btn-danger' onclick='$(this).parent().parent().remove()'>Remove</button></td>\
        <tr>";
        $('#addedtable').append(str);
        console.log(type_text);
    })
</script>

@endpush
