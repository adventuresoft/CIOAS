@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@push('style')
@endpush
@section('title', 'chairman Create')
@section('content')

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
                <h1>পর্ষদ তথ্য </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('chairman.index') }}">পর্ষদ </a></li>
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
                        <input type="hidden" name="council_id" value="{{$council->id}}">
                        <input type="hidden" name="id" value="{{$cm->id}}">
                        <input type="hidden" name="council_member_id" value="{{$cm->id}}">
                        <input type="hidden" name="user_id" value="{{$cm->user_id}}">
                        <input type="hidden" name="concilor_designation_id" value="{{$cm->concilor_designation_id}}">
                        <input type="hidden" name="word_no_text" value="{{$cm->word_no_text}}">
                        <input type="hidden" name="start_date" value="{{$cm->start_date}}">
                        <input type="hidden" name="end_date" value="{{$cm->end_date}}">
                        <input type="hidden" name="end_date" value="{{$cm->end_date}}">
                        <input type="hidden" name="order" value="{{$cm->order}}">
                        <div class="card-body">
                            <div class="row h3">
                               পর্ষদ 
                           </div>
                           <div class="row mt-5">
                            <table class="table table-bordered font-weight-bold">
                                <tr>
                                    <td class="titleheading">বিভাগ</td>
                                    <td class="colon">:</td>
                                    <td class="inputfield">
                                        {{$council->union->Thana->District->Division->name??''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="titleheading">জেলা</td>
                                    <td class="colon">:</td>
                                    <td class="inputfield">
                                     {{$council->union->Thana->District->name??''}}
                                 </td>
                             </tr>
                             <tr>
                                <td class="titleheading">থানা</td>
                                <td class="colon">:</td>
                                <td class="inputfield">
                                    {{$council->union->Thana->name??''}}
                                </td>
                            </tr>
                            <tr>
                                <td>ইউনিয়ন / পৌরসভা</td>
                                <td>:</td>
                                <td>
                                    {{$council->union->name??''}}
                                </td>
                            </tr>
                            <tr>
                                <td>মেয়াদ</td>
                                <td>:</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-row justify-content-between w-50">
                                            <div style="width: 20%;">Start Date : </div>
                                            <div style="width: 80%;"> 
                                                {{date('d-m-Y',strtotime($council->start_date))}}
                                            </div>
                                        </div> 
                                        <div class="d-flex flex-row justify-content-between w-50 ">
                                            <div style="width: 20%;margin-left: 20px;">End Date : </div>
                                            <div style="width: 80%;">
                                             {{date('d-m-Y',strtotime($council->end_date))}}
                                         </div>
                                     </div>
                                 </div>
                             </td>
                         </tr>
                     </table>
                 </div>

                 @php
                 $wordTitles=$cm->word_no_text;
                 if($cm->concilor_designation_id==1){
                    $heading="চেয়ারম্যান / মেয়র ";
                }
                elseif($cm->concilor_designation_id==2){
                   $heading="সদস্য / কমিশনার";

               }
               elseif($cm->concilor_designation_id==3){
                   $heading="সংরক্ষিত মহিলা সদস্য / কমিশনার";               
               }
               else{
                   $heading="প্যানেল চেয়ারম্যান / মেয়র ";
               }
               @endphp

               <div class="row mt-5">
                <table class="table table-bordered font-weight-bold">                

                    <tr>
                        <td class="titleheading">{{ $heading}}</td>
                        <td class="colon">:</td>
                        <td class="wordno">{{ $wordTitles}}</td>
                        <td class="inputfield">{{$cm->User->name}}</td>
                    </tr>

                </table>
            </div>

            <div class="row mt-5">
                <table class="table table-bordered font-weight-bold">                

                    <tr>
                        <td class="titleheading">নতুন {{ $heading}}</td>
                        <td class="colon">:</td>
                        <td class="wordno">{{ $wordTitles}}</td>
                        <td class="inputfield">
                            <select type="text" class="form-control select2" id="member_id" name="member_id">
                                @foreach($chairmans as $chairman)
                                <option value="{{$chairman->user_id}}">{{$chairman->User->name}}</option>
                                @endforeach
                            </select>


                        </td>
                    </tr>
                    <tr>
                        <td>মেয়াদ</td>
                        <td>:</td>
                        <td colspan="2">
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-row justify-content-between w-50">
                                    <div style="width: 20%;">Start Date : </div>
                                    <div style="width: 80%;"> 
                                        <input type="date" name="new_start_date" class="form-control" >
                                    </div>
                                </div> 
                                <div class="d-flex flex-row justify-content-between w-50 ">
                                    <div style="width: 20%;margin-left: 20px;">End Date : </div>
                                    <div style="width: 80%;">
                                        <input type="date" name="new_end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>কারণ </td>
                        <td>:</td>
                        <td colspan="2">
                            <input type="text" name="reason" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>নোট</td>
                        <td>:</td>
                        <td colspan="2">
                            <input type="text" name="note" class="form-control">
                        </td>
                    </tr>

                </table>
            </div>


            <div class="d-flex flex-row justify-content-center">
                <div class="form-group">

                    <input type="radio" class="" name="status" checked id="active" value="1"> <label for="active">Active</label>

                    <input type="radio" name="status" id="inactive" value="0"> <label for="inactive">Inactive</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="form-group text-center">
                <button type="submit" class="btn btn-info">Update </button>
                <a href="{{ route('chairman.index') }}" class="btn btn-dark">Back</a>

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

<script>
    $(document).ready(function() {
        $("#peoplePersonalForm").on('submit', function(e) {

            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('chairman.councilorUpdate') }}",
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
        let district_id = $('#district_id')
        let division_id = $(this).val();
        if (division_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-districts-by-division') }}/"+division_id,
                beforeSend: function() {
                    district_id.prop("disabled", true);
                    console.log("Searcing Districts");
                },
                success: function(response) {
                    district_id.html(response)
                    district_id.prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    district_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        } else {
            district_id.prop("disabled", true);
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
                    present_thana_id.prop("disabled", true);
                    console.log("Searcing Thana");
                },
                success: function(response) {
                    present_thana_id.html(response)
                    present_thana_id.prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    present_thana_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }  
        else {
            present_thana_id.prop("disabled", true);
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
                    present_union_id.html(response)
                    present_union_id.prop("disabled", false);
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
                    // console.log(response);
                    ward_no.html(response)
                    $('#word_1_id').html(response);
                    $('#word_2_id').html(response);
                    $('#word_3_id').html(response);
                    $('#word_4_id').html(response);
                    $('#word_5_id').html(response);
                    $('#word_6_id').html(response);
                    $('#word_7_id').html(response);
                    $('#word_8_id').html(response);
                    $('#word_9_id').html(response);
                    $('#reserved_word_1_id').html(response);
                    $('#reserved_word_2_id').html(response);
                    $('#reserved_word_3_id').html(response);
                    $('#panel_chairman_id').html(response);

                    ward_no.prop("disabled", false);
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
