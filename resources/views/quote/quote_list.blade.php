<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            @if (count($quotes) > 0)
                @php
                    $firstData = json_decode($quotes[0]->form_data, true);
                @endphp

                @foreach (array_keys($firstData) as $field)
                    <th>{{ ucfirst(str_replace('_', ' ', $field)) }}</th>
                @endforeach
            @endif
            <th>Status</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($quotes as $index => $quote)
            <tr>
                <td>{{ $quote->id }}</td>
                <td class="nowrap">{{ showDateFormat($quote->date) }}</td>
                @php
                    $formData = json_decode($quote->form_data, true);
                @endphp

                @foreach ($formData as $value)
                    <td>
                        @if (is_array($value))
                            {{ implode(', ', $value) }}
                        @elseif(is_null($value))
                            -
                        @else
                            {{ $value }}
                        @endif
                    </td>
                @endforeach
                <td>
                    @if ($quote->status)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td>
                    {{ date('d M,Y h:i:A', strtotime($quote->created_at)) }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%">No quotes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
