{{-- resources/views/components/table.blade.php --}}
@props(['data' => collect(), 'title' => null, 'actions' => null])

@php
$data = collect($data ?? []);
@endphp


{{-- {{ dump($data->toArray()) }} --}}

<div class="card mt-4">
    @if ($title)
    <div class="card-header bg-light border-bottom">
        <h5 class="m-0">{{ $title }}</h5>
    </div>
    @endif

    <div class="card-body p-0">
        <table class="table table-striped mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    @if ($data->isNotEmpty())
                    @php
                    $first = (array) $data->first()->toArray();
                    @endphp
                    @foreach (array_keys($first) as $key)
                    <th scope="col" class="text-capitalize">{{ str_replace('_', ' ', $key) }}</th>
                    @endforeach
                    @if (isset($actions))
                    <th scope="col">Actions</th>
                    @endif
                    @else
                    <th>No data available</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse ($data as $item)
                @php
                $itemArray = (array) $item->toArray();
                unset($itemArray['password'], $itemArray['remember_token']);
                @endphp
                <tr>
                    @foreach ($itemArray as $value)
                    <td>
                        @if (is_array($value))
                        {{ json_encode($value) }}
                        @elseif (is_object($value))
                        {{ method_exists($value, 'toJson') ? $value->toJson() : get_class($value) }}
                        @else
                        {{ $value }}
                        @endif
                    </td>
                    @endforeach
                </tr>
                @empty
                <tr>
                    <td colspan="100%" class="text-center py-3">No records found.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>