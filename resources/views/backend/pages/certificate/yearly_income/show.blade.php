@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Income'])
@section('title', 'Income Certificate')
@section('content')
<div class="container">
  <div class="card mt-2">
      <div class="card-body border border-dark ">
          <div class="border border-5 border-info p-5">
              <div class="row  text-center">
                  <div class="col-md-12 ">
                      <img height="100" width="100" class="mx-auto d-block"
                          src="{{ isset($certificate->user->institute->top_image) ? asset($certificate->user->institute->top_image)  : asset('public/backend/img/certificate/govt-bd-logo.png') }}" alt="govt-bd-logo">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-2 text-right">
                      <img height="100" width="100" class="mx-auto d-block"
                          src=" {{isset($certificate->user->institute->left_image) ? asset($certificate->user->institute->left_image)  : 'https://seeklogo.com/images/M/moharajpur-union-logo-6FAC2CBD46-seeklogo.com.png '}}"
                          alt="govt-bd-logo">
                  </div>
                  <div class="col-md-8 text-center">
                      <h1 class="text-danger bold">{{ $certificate->user->institute->union->name ?? '' }} Union Parishad
                      </h1>
                      <p>
                          PS.:-   <strong class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                          Dist.:- <strong class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                  <strong class="text-danger">Dhaka</strong>,Bangladesh
                      </p>
                  </div>
                  <div class="col-md-2 text-left">
                      <img height="100" width="100" class="mx-auto d-block"
                          src="{{isset($certificate->user->institute->right_image) ? asset($certificate->user->institute->right_image)  : 'https://upload.wikimedia.org/wikipedia/en/thumb/a/ab/Mujib_100_Logo.svg/1200px-Mujib_100_Logo.svg.png'}} "
                          alt="govt-bd-logo">
                  </div>
              </div>
              <div class="row character-certificate">
                  <div class="col-md-2">
                      <h6 class="text-success mt-4">No. : {{ $certificate->system_id ?? '' }}</h6>
                  </div>
                  <div class="col-md-8 text-center">
                      <h3 class="text-light bg-success bold">I n c o m e  C e r t i f i c a t e</h3>
                  </div>
                  <div class="col-md-2">
                      <h6 class="text-success mt-4">Date : {{ date('d.m.Y', strtotime($certificate->created_at)) }}
                      </h6>
                  </div>
              </div>
              <div class="row mt-5">
                  <div class="col-md-12 certificate-body">
                      <p>This is to certify that <strong class="text-danger">{{ $certificate->user->name ?? '' }}</strong>
                          Id no.: <strong class="text-danger"> {{ $certificate->user->system_id ?? '' }}</strong>
                          son of <strong
                              class="text-danger">{{ family_live_status($certificate->user->familyInfo->father_live_status ?? 0) }}
                              {{ $certificate->user->familyInfo->father_name ?? '' }}</strong> & <strong
                              class="text-danger">{{ family_live_status($certificate->user->familyInfo->mother_live_status ?? 0) }}
                              {{ $certificate->user->familyInfo->mother_name ?? '' }}</strong>,
                          Village: <strong
                              class="text-danger">{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</strong>,
                          <strong
                              class="text-danger">Road-{{ $certificate->user->addressInfo->permanent_road ?? '' }}</strong>,
                          <strong class="text-danger">House-03</strong>,
                          <strong class="text-danger">Ward
                              No.-{{ $certificate->user->addressInfo->presentWard->en_ward_no ?? '' }}</strong>, PO.:
                          <strong class="text-danger">{{ $certificate->user->institute->union->name ?? ''  }}</strong>, PS.
                          : <strong
                              class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                          Dist.: <strong
                              class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                          is known to me for about long time.
                          <br>
                          He is a citizen of Bangladesh by birth.
                      </p>
                      <br>
                      <p>To the best of my knowledge, he bears a good moral character and is not involved is such
                          activities which are against the country freedom and peace.</p>
                      <br>
                      <p>I wish all success and prosperity in his life.</p>
                      <br>
                      <p class="text-right">Chairman/Meyor</p>
                      <p>NB.: Any Query <a href="https://www.upbd.com" target="_blank">www.upbd.com</a></p>
                  </div>
              </div>
          </div>


      </div>
      <div class="card-footer">
          <p>This report generated by Jatri 24 Ltd. <a href="https://www.jatri24.com">www.jatri24.com</a></p>
          <button id="printPageButton" class="btn btn-outline-secondary btn-sm text-right"
              onClick="window.print();">Print</button>

      </div>
  </div>
</div>
@endsection

