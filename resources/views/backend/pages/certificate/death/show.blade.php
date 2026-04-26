@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Death'])
@push('style')
@endpush
@section('title', 'Death Certificate')
@section('content')
  <div class="container">
      <div class="row  text-center">
          <div class="col-md-12 ">
              <div class="mt-2">
                <h3>SUKTAIL UNION PARISHAD</h3>
                <h1>Certificate of Death</h1>

                <p>This is to certify Mr. {{$user->name}},
                  @if ($user->familyInfo)
                  Father's Name: {{$user->familyInfo->father_name}}, Mother's Name: {{$user->familyInfo->mother_name}}.

                  @endif
              </p>
                <p>He is a member of our Union. We know him innocent and good citizen. </p>
                <p>We wish his success.</p>
              </div>

          </div>

      </div>
      <div class="row mt-5">
          <div class="col-md-12">
            <table class="table ">
                <tr class="text-center">
                  <td>Authority</td>
                  <td>Seal</td>
                  <td>Chairman</td>
                </tr>

            </table>
          </div>

      </div>

  </div>
@endsection
@push('script')
@endpush
