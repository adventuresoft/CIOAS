<h3 class="card-title">
   <a href="{{ isset($user->id) ? route('people.edit', $user->id) : '#'}}">           <span class="{{$active_tab == 'personal' ? 'text-light' : 'text-dark'}}">Personal</span>        </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.family', $user->id) : '#'}}">         <span class="{{$active_tab == 'family' ? 'text-light' : 'text-dark'}}">Family</span>            </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.address', $user->id) : '#'}}">        <span class="{{$active_tab == 'address' ? 'text-light' : 'text-dark'}}">Address</span>          </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.education', $user->id) : '#'}}">      <span class="{{$active_tab == 'education' ? 'text-light' : 'text-dark'}}">Education</span>      </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.professional', $user->id) : '#'}}">   <span class="{{$active_tab == 'professional' ? 'text-light' : 'text-dark'}}">Profession</span>  </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.financial', $user->id) : '#'}}">      <span class="{{$active_tab == 'financial' ? 'text-light' : 'text-dark'}}">Financial</span>      </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.property', $user->id) : '#'}}">       <span class="{{$active_tab == 'property' ? 'text-light' : 'text-dark'}}">Property</span>        </a> <span class="text-secondary">|</span>
   {{-- <a href="{{ isset($user->id) ? route('people.health', $user->id) : '#'}}">         <span class="{{$active_tab == 'health' ? 'text-light' : 'text-dark'}}">Health</span>            </a> <span class="text-secondary">|</span> --}}
   <a href="{{ isset($user->id) ? route('people.disability', $user->id) : '#'}}">     <span class="{{$active_tab == 'disability' ? 'text-light' : 'text-dark'}}">Disability</span>    </a> <span class="text-secondary">|</span>
   <a href="{{ isset($user->id) ? route('people.freedom', $user->id) : '#'}}">        <span class="{{$active_tab == 'freedom' ? 'text-light' : 'text-dark'}}">Freedom Fighter</span>  </a> <span class="text-secondary">|</span>
</h3>
