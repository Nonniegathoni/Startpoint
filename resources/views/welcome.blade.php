@extends('layouts.app')

@section('content')
<div class="bg-gray-900">
    <div class="container mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
            Build Your Next Big Thing with Startpoint
        </h1>
        <p class="mt-4 text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
            Our platform provides all the tools you need to turn your idea into a reality.
            Join us and start building today.
        </p>
        <div class="mt-8 flex justify-center">
            <div class="w-full max-w-md">
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required
                           class="flex-grow px-4 py-3 rounded-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                            class="px-8 py-3 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg transition duration-200">
                        Get Started
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection