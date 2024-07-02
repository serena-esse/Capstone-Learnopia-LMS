<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <style>
        .cover {
            position: relative;
            text-align: center;
            color: white;
        }
        .cover img {
            width: 100%;
            height: auto;
        }
        .cover .button-container {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow under the button */
        }
        .info-section {
            display: flex;
            flex-direction: column;
            margin: 20px 0;
            align-items: center;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin: 40px 0;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 16px; /* More rounded corners */
            overflow: hidden;
        }
        .info-item:nth-child(odd) {
            background: #ffe5ec; /* Pastel pink */
        }
        .info-item:nth-child(even) {
            background: #e0f7fa; /* Pastel blue */
            flex-direction: row-reverse;
        }
        .info-item img {
            width: 30%;
            height: auto;
        }
        .info-item p {
            width: 70%;
            padding: 20px;
        }
        
        .centered-logo {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
    </style>

    <div class="cover">
        <img src="{{ asset('images/cover.jpg') }}" alt="Cover Image">
        <x-primary-button class="button-container">
            <a href="{{ route('courses.index') }}">Courses</a>
        </x-primary-button>
    </div>
    <div class="centered-logo">
        <x-application-logo />
    </div>
    
    <div class="info-section">
        <div class="info-item">
            <img src="{{ asset('images/image1.jpg') }}" alt="Image 1">
            <p>Descrizione della piattaforma 1</p>
        </div>
        <div class="info-item reverse">
            <p>Descrizione della piattaforma 2</p>
            <img src="{{ asset('images/image2.jpg') }}" alt="Image 2">
        </div>
        <div class="info-item">
            <img src="{{ asset('images/image3.jpg') }}" alt="Image 3">
            <p>Descrizione della piattaforma 3</p>
        </div>
    </div>
</x-app-layout>
