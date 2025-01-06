@extends('components.kaprodi')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-4 mt-5">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                
                    {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection