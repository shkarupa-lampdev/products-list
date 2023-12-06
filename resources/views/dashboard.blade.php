<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Price')}}</th>
                                    <th>{{ __('Discount Percentage')}}</th>
                                    <th>{{ __('Ratig')}}</th>
                                    <th>{{ __('Stock')}}</th>
                                    <th>{{ __('Brand')}}</th>
                                    <th>{{ __('Category')}}</th>
                                    <th>{{ __('Thumbnail')}}</th>
                                    <th>{{ __('Images')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount_percentage }}</td>
                                        <td>{{ $product->rating }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>
                                            <img
                                                src="{{ $product->thumbnail }}"
                                                alt="{{ __('Thumbnail') }}"
                                            >
                                        </td>
                                        <td>
                                            <div class="row">
                                                @foreach (json_decode($product->images) as $image)
                                                    <div class="col-md-6 col-lg-4">
                                                        <img
                                                            src="{{ $image }}"
                                                            class="img-fluid mb-2"
                                                            alt="{{ __('Product Image') }}"
                                                        >
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
