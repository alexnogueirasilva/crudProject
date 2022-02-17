<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product name') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Tags') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date create') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date update') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <span>{{ __('Actions') }}</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @if($products->count() > 0 )
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ asset('image/product.png') }}"
                                             alt="{{ $product->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach($product->tags as $tag)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><a
                                            href="{{ route('tag.edit', ['tag' => $tag->id]) }}">{{ $tag->name }}</a></span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-900">{{ date('d/m/Y H:i', strtotime($product->created_at))}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Illuminate\Support\Carbon::parse($product->created_at)->diffForHumans() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                   class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                <form
                                    action="{{ route('product.destroy', ['product' => $product->id]) }}"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            {{ __('No relationship find produto/tag') }}
                        </td>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
