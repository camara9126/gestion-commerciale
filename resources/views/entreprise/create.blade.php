<x-guest-layout>
    <div class="max-w-md mx-auto mt-10">

        <h2 class="text-2xl font-bold mb-4">Creer votre entreprise</h2>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{route('entreprise.store')}}">
            @csrf
            <div class="mb-4">
                <label class="block">Nom de l'enytreprise</label>
                <input type="text" name="nom" class="w-full border-rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block">Telephone</label>
                <input type="text" name="telephone" class="w-full border-rounded p-2">
            </div>
            <div class="mb-4">
                <label class="block">Adresse</label>
                <input type="text" name="adresse" class="w-full border-rounded p-2">
            </div>
            <button type="submit" class="bg-blue-600 px-4 py-2 rounded">Creer</button>
        </form>        
    </div>

          
</x-guest-layout>

