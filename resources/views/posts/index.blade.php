@extends('welcome')

@section('content')
    <table class="table-auto w-full">
        <thead class="text-xs font-semibold uppercase text-gray-400">
        <tr>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                    <a href="?sortBy=title&direction={{ request('direction') === 'desc' ? 'asc' : 'desc' }}&page={{ $posts->currentPage() }}">
                        Titre
                    </a>
                </div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                    Points de l'auteur
                </div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                    <a href="?sortBy=status&direction={{ request('direction') === 'desc' ? 'asc' : 'desc' }}&page={{ $posts->currentPage() }}">
                        Statut
                    </a>
                </div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                    <a href="?sortBy=analysis&direction={{ request('direction') === 'desc' ? 'asc' : 'desc' }}&page={{ $posts->currentPage() }}">
                        Analyse
                    </a>
                </div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                    Actions
                </div>
            </th>
        </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-100">
        @foreach($posts as $post)
            <tr>
                <td class="p-2 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="font-medium text-gray-800">
                            {{ $post->title }}
                        </div>
                    </div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left">
                        <span
                            class="text-black bg-blue-300 font-medium rounded-full text-xs px-5 py-2.5 text-center mr-2 mb-2"
                        >
                            {{ $post->user->total_points }}
                        </span>
                    </div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left">
                        <span class="bg-{{ $post->status->color() }}-100 text-{{ $post->status->color() }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-{{ $post->status->color() }}-900 dark:text-{{ $post->status->color() }}-300">{{ $post->status }}</span>
                    </div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left font-medium text-blue-500">{{ $post->likes_count }} "J'aime"</div>
                    <div class="text-left font-medium text-yellow-500">{{ $post->comments_count }} commentaires</div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    @if ($post->status !== \App\Enums\PostStatusEnum::VALIDATED)
                    <form
                        action="{{ route('posts.validate', $post) }}"
                        method="post"
                    >
                        @csrf
                        <button
                            type="submit"
                            class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center mr-2 mb-2"
                        >
                            Valider
                        </button>

                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $posts->appends(request()->input())->links() }}
@endsection
