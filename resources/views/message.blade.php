<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Mensaje') }}
        </h2>
    </x-slot>

    <div class="py-12 " >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl  sm:rounded-lg">
          

            <form method="post" class="flex flex-col p-2 items-center align-center">
                
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex flex-col w-1/2">
                    <label class="" style="font-weight:bold">Para: </label>
                    <select  name="to_user_id" id="to_user_id">
                        @foreach ($users as $user )
                            <option value="{{$user->id}}">{{$user->name}} - {{$user->email}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col mt-2 mb-2 w-1/2">
                    <label class="font-bold">Asunto: </label>
                   <input type="text" placeholder="subject here" class="w-1/2" name="subject" id="subject">
                   @error('subject')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col mt-2 mb-2 w-1/2">
                    <label class="font-bold">Mensaje: </label>
                    <textarea name="body" placeholder="type your message here" style="resize: none;" id="subject" cols="30" rows="10"></textarea>
                    @error('body')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                
                </div>
                <button type="submit" class="mt-2 bg-red-500 text-white p-2">Enviar Mensaje</button>
            </form>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            </div>
        </div>
    </div>
</x-app-layout>