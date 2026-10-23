<x-layout>
    @foreach ($users as $user)
    <div class="px-10 py-10 margin-auto">
        <img src="{{ $user->avatar }}">
    </div>
    @endforeach
</x-layout>