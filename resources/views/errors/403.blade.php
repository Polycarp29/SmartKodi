@extends('errors.layouts.errors')
@section('title', 'Service Unavailable')

@section('content')
    <div class="text-center">
        <!-- Illustration -->
        <div class="mb-6">
            <i class="fa-solid fa-ban text-amber-600 text-6xl animate-pulse"></i>
        </div>

        <!-- Main Content -->
        <h1 class="font-extrabold text-8xl text-amber-700 tracking-tight">403</h1>
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mt-3">Oops! Forbidden</h2>
        <p class="text-gray-500 text-lg max-w-md mx-auto mt-2">
            You do not have permission to access this resource.
        </p>

        <!-- Actions -->
        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ url('/') }}"
                class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white text-lg font-medium rounded-lg transition duration-200 shadow-sm">
                <i class="fa-solid fa-house mr-3"></i> Go to Dashboard
            </a>
            <button onclick="history.back()"
                class="inline-flex items-center px-6 py-3 border border-amber-500 text-amber-700 hover:bg-amber-50 text-lg font-medium rounded-lg transition duration-200">
                <i class="fa-solid fa-arrow-left mr-3"></i> Go Back
            </button>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-gray-400 text-sm">
            &copy; {{ date('Y') }} <span class="font-semibold text-amber-700">Smartkoddi</span>. All rights
            reserved.
        </div>
    </div>
@endsection
