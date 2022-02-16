<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <!-- -->
                @if(Session::has('info'))
                    <div class="bg-indigo-100 border border-indigo-400 text-indigo-700 px-4 py-3 rounded relative"
                         role="alert">
                        <strong class="font-bold">Alerta</strong>
                        <span class="block sm:inline"> {{Session::get('info')}}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-indigo-500" role="button" xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 20 20"><title>Close</title><path
            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg></span>
                    </div>
            @endif
            <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name tag') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Product') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <span>{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    @if($tags->count() > 0)
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($tags as $tag)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full"
                                                                 src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                                 alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div
                                                                class="text-sm font-medium text-gray-900">{{ $tag->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900"> Proutos relacionandos</div>
                                                    @foreach($tag->product as $product)
                                                        <div class="text-sm  text-gray-900"><a href="{{ route('product.edit', ['product' => $product->id]) }}"><span
                                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $product->name }}</span></a></div>
                                                    @endforeach
                                                    <div class="text-sm py-4 text-gray-900">
                                                        Total: {{ $tag->product->count()}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"></span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <a href="{{ route('tag.edit', ['tag' => $tag->id]) }}"
                                                       class="px-6 py-4 text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                                    <form action="{{ route('tag.destroy', ['tag' => $tag->id]) }}"
                                                          method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                                class="px-6 py-4 text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                                Nenhuma Tag Cadastrada...
                                            </td>
                                        @endif
                                        <!-- More people... -->
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- -->

            </div>
        </div>
    </div>
</x-app-layout>
