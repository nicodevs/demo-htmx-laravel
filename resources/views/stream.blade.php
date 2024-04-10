<x-app-layout>
    <div class="bg-white flex flex-col gap-6 p-6 lg:flex-row">
        <div class="lg:w-2/3">
            <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/gerh8ywmuyM?si=aGPlpJgk0HSm4IDJ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="lg:w-1/3">
            @fragment('comment-form')
                <form
                    method="post"
                    action="{{ route('comments.store') }}"
                    hx-post="{{ route('comments.store') }}">
                    @csrf
                    <input
                        name="text"
                        required
                        autofocus
                        class="w-full"
                        placeholder="Type your comment and press Enter" />
                </form>
            @endfragment
            <div
                id="comments"
                hx-get="{{ route('comments.index') }}"
                hx-trigger="loadComments"
                hx-swap="afterbegin"
                class="mt-2 flex flex-col gap-2">
                @fragment('comments')
                    @if (isset($comments))
                        @foreach ($comments as $comment)
                            <div>
                                <strong>{{ $comment->user->name }}</strong>
                                {{ $comment->text }}
                            </div>
                        @endforeach
                    @endif
                @endfragment
            </div>
        </div>
    </div>
</x-app-layout>
