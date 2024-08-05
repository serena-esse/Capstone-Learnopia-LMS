<x-app-layout>
      

<div class="cover">
    <video autoplay muted loop src="{{ asset('images/cover.mp4') }}">
        Il tuo browser non supporta il tag video.
    </video>
    <div class="button-container">
        <a href="{{ route('courses.index') }}" class=" text-white font-bold py-1 px-3 rounded-lg shadow-lg inline-flex items-center justify-center text-lg">LAUNCH <i class="fa-solid fa-rocket"></i></a>
    </div>
</div>
    
</x-app-layout>
