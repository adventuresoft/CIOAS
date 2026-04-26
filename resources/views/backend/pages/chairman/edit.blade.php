@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@section('title', 'Chairman Edit')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>People Information</h1>
      </div>
      <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('chairman.index')}}">Chairman</a></li>
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

                    <form class="form-horizontal" id="peoplePersonalForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$council->id}}">
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
                                               <option {{$council->union->Thana->District->division_id ==$division->id?'selected':'' }} value="{{$division->id}}">{{$division->name}}</option>
                                               @endforeach
                                               @endif
                                           </select>
                                       </td>
                                   </tr>
                                   <tr>
                                    <td class="titleheading">জেলা</td>
                                    <td class="colon">:</td>
                                    <td class="inputfield">
                                     <select required class="form-control select2" name="district_id" id="district_id">
                                        @foreach ($districts as $district)
                                        <option {{$council->union->Thana->District->id==$district->id?'selected':'' }} value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="titleheading">থানা</td>
                                <td class="colon">:</td>
                                <td class="inputfield">
                                   <select  class="form-control select2" name="thana_id" id="thana_id">
                                    @foreach ($thanas as $thana)
                                    <option {{$council->union->Thana->id==$thana->id?'selected':'' }} value="{{$thana->id}}">{{$thana->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>ইউনিয়ন / পৌরসভা</td>
                            <td>:</td>
                            <td>
                                <select  class="form-control select2"  name="union_id" id="union_id">
                                    @foreach ($unions as $union)
                                    <option {{$council->union->id==$union->id?'selected':'' }} value="{{$union->id}}">{{$union->name}}</option>
                                    @endforeach
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
                                            <input type="date" value="{{$council->start_date}}" name="start_date" class="form-control" >
                                        </div>
                                    </div> 
                                    <div class="d-flex flex-row justify-content-between w-50 ">
                                        <div style="width: 15%;margin-left: 20px;">End Date</div>
                                        <div style="width: 100%;">
                                            <input type="date" value="{{$council->end_date}}" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="row mt-5">
                    <table class="table table-bordered font-weight-bold">
                        @php

                        $oldchairman=$council->councilMember->filter(function($cn){
                         if($cn->concilor_designation_id==1){
                            return $cn->User->name;
                        }

                    })->first();
                    @endphp
                    <tr>
                        <td class="titleheading">চেয়ারম্যান / মেয়র </td>
                        <td class="colon">:</td>
                        <td class="inputfield">
                            <select type="text" class="form-control select2" id="chairman_id" name="userinfo[]">
                                @foreach($chairmans as $chairman)
                                <option {{$oldchairman->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
                                @endforeach
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
                        @php
                        $member1=$council->councilMember->filter(function($cn){
                         if($cn->concilor_designation_id==2 && $cn->order==2){
                            return $cn->User->name;
                        }

                    })->first();
                    @endphp
                    <td class="inputfield"> 
                        <select class="form-control select2" name="userinfo[]" id="word_1_id">
                           @foreach($chairmans as $chairman)
                           <option value="{{$chairman->user_id}}">{{$chairman->User->name}}</option>
                           @endforeach
                       </select>
                   </td>
               </tr>
               <tr>
                <td>সদস্য / কমিশনার </td>
                <td>:</td>
                <td>ওয়ার্ড নং-২</td>

                @php
                $member2=$council->councilMember->filter(function($cn){
                 if($cn->concilor_designation_id==2 && $cn->order==3){
                    return $cn->User->name;
                }

            })->first();

            @endphp

            <td>
                <select class="form-control select2" name="userinfo[]" id="word_2_id">
                    @foreach($chairmans as $chairman)
                    <option {{$member2->User->id==$chairman->user_id?'selected':''}}  value="{{$chairman->user_id}}">{{$chairman->User->name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>সদস্য / কমিশনার </td>
            <td>:</td>
            <td>ওয়ার্ড নং-৩</td>
            @php
            $member3=$council->councilMember->filter(function($cn){
             if($cn->concilor_designation_id==2 && $cn->order==4){
                return $cn->User->name;
            }

        })->first();

        @endphp

        <td>
            <select class="form-control select2" name="userinfo[]" id="word_3_id">
                @foreach($chairmans as $chairman)
                <option {{$member3->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
                @endforeach
            </select>
        </td>
    </tr> 
    <tr>
        <td>সদস্য / কমিশনার </td>
        <td>:</td>
        <td>ওয়ার্ড নং-৪</td>
        @php
        $member4=$council->councilMember->filter(function($cn){
         if($cn->concilor_designation_id==2 && $cn->order==5){
            return $cn->User->name;
        }

    })->first();

    @endphp
    <td>
     <select class="form-control select2" name="userinfo[]" id="word_4_id">
        @foreach($chairmans as $chairman)
        <option {{$member4->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
        @endforeach
    </select>
</td>
</tr>
<tr>
    <td>সদস্য / কমিশনার </td>
    <td>:</td>
    <td>ওয়ার্ড নং-৫</td>
    @php
    $member5=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==2 && $cn->order==6){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
  <select class="form-control select2" name="userinfo[]" id="word_5_id">
    @foreach($chairmans as $chairman)
    <option {{$member5->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
    @endforeach
</select>
</td>
</tr>
<tr>
    <td>সদস্য / কমিশনার </td>
    <td>:</td>
    <td>ওয়ার্ড নং-৬</td>
    @php
    $member6=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==2 && $cn->order==7){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
    <select class="form-control select2" name="userinfo[]" id="word_6_id">
     @foreach($chairmans as $chairman)
     <option {{$member6->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
     @endforeach
 </select>
</td>
</tr>
<tr>
    <td>সদস্য / কমিশনার </td>
    <td>:</td>
    <td>ওয়ার্ড নং-৭</td>
    @php
    $member7=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==2 && $cn->order==8){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
 <select class="form-control select2" name="userinfo[]" id="word_7_id">
    @foreach($chairmans as $chairman)
    <option {{$member7->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
    @endforeach
</select>
</td>
</tr> 
<tr>
    <td>সদস্য / কমিশনার </td>
    <td>:</td>
    <td>ওয়ার্ড নং-৮</td>
    @php
    $member8=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==2 && $cn->order==9){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
  <select class="form-control select2" name="userinfo[]" id="word_8_id">
     @foreach($chairmans as $chairman)
     <option {{$member8->User->id==$chairman->id?'selected':''}}  value="{{$chairman->id}}">{{$chairman->User->name}}</option>
     @endforeach
 </select>
</td>
</tr>
<tr>
    <td>সদস্য / কমিশনার </td>
    <td>:</td>
    <td>ওয়ার্ড নং-৯</td>
    @php
    $member9=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==2 && $cn->order==10){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
  <select class="form-control select2" name="userinfo[]" id="word_9_id">
    @foreach($chairmans as $chairman)
    <option  {{$member9->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
    @endforeach
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
            @php
            $resmember=$council->councilMember->filter(function($cn){
             if($cn->concilor_designation_id==3 && $cn->order==11){
                return $cn->User->name;
            }

        })->first();

        @endphp

        <td class="inputfield">

          <select class="form-control select2" name="userinfo[]" id="reserved_word_1_id">
           @foreach($chairmans as $chairman)
           <option {{$resmember->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
           @endforeach
       </select>
   </td>
</tr>
<tr>
    <td>সংরক্ষিত মহিলা সদস্য / কমিশনার</td>
    <td>:</td>
    <td>ওয়ার্ড নং-২ (৪,৫,৬) </td>
    @php
    $resmember2=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==3 && $cn->order==12){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
   <select class="form-control select2" name="userinfo[]" id="reserved_word_2_id">
    @foreach($chairmans as $chairman)
    <option {{$resmember2->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
    @endforeach
</select>
</td>
</tr>
<tr>
    <td>সংরক্ষিত মহিলা সদস্য / কমিশনার</td>
    <td>:</td>
    <td>ওয়ার্ড নং-৩ (৭,৮,৯)</td>
    @php
    $resmember3=$council->councilMember->filter(function($cn){
     if($cn->concilor_designation_id==3 && $cn->order==13){
        return $cn->User->name;
    }

})->first();

@endphp
<td>
    <select class="form-control select2" name="userinfo[]" id="reserved_word_3_id">
        @foreach($chairmans as $chairman)
        <option {{$resmember3->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
        @endforeach
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

            @php
            $panelChairman=$council->councilMember->filter(function($cn){
               if($cn->concilor_designation_id==4){
                return $cn->User->name;
            }

        })->first();

        @endphp
        <td class="inputfield">
         <select class="form-control select2" name="userinfo[]" id="panel_chairman_id">
            @foreach($chairmans as $chairman)
            <option {{$panelChairman->User->id==$chairman->id?'selected':''}} value="{{$chairman->id}}">{{$chairman->User->name}}</option>
            @endforeach
        </select>
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
        <a href="{{ route('chairman.index') }}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-info">Update & Next </button>
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

<script>
   $(document).ready(function() {
    $("#peoplePersonalForm").on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $.ajax({
            type: "post",
            url: "{{ route('chairman.fromupdate') }}",
            data: new FormData(this),
            dataType: "json",
            contentType:false,
            cache:false,
            processData:false,
            beforeSend: function() {
                thisForm.find('button[type="submit"]').prop("disabled",true);
                $('.error').text('')
            },
            success: function (response) {
                thisForm.find('button[type="submit"]').prop("disabled",false);
                toastr.success(response.message);
                setTimeout(function() {
                   location.href = response.redirect_url;
               }, 2000)
            },
            error: function(xhr, status, error) {
                thisForm.find('button[type="submit"]').prop("disabled",false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
                $.each(responseText.errors, function(key, val) {
                    thisForm.find("." + key + "-error").text(val[0]);
                });
            }
        });
    })
})

   $(document).on('change', '#birth_place', function(e){
    e.preventDefault();
    let birth_place = $(this).val();
    if( birth_place == 1){
        $('.districts').removeClass('d-none');
        $('.countries').addClass('d-none');
    } else if (birth_place == 2) {
        $('.countries').removeClass('d-none');
        $('.districts').addClass('d-none');
    } else {
        $('.districts').addClass('d-none');
        $('.countries').addClass('d-none');
    }
})

</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function() {
        readURL(this);

    });
</script>
@endpush
