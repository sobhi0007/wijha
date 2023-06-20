<x-app-layout>
    <div class="container-fluied m-3">
        <div class="row">
            <div class="col-12 col-md-6 p-3">
              <div class="shadow boder rounded-lg  p-3">
               @include('profile.partials.update-profile-information-form')
               </div>
            </div>
              <div class="col-12 col-md-6 p-3">
                <div class="shadow boder rounded-lg p-3">
                  @include('profile.partials.update-password-form')
              </div>
            </div>
              {{-- <div class="col-12 p-3">
              <div class="shadow boder rounded-lg  p-3">
                   @include('profile.partials.delete-user-form')
              </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>



