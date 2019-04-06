<table class="table table-striped">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>Country code</th>
            <th>Phone num</th>
        </tr>
    </thead>
    <tbody>
    @foreach($customerCountryPhones as $customerCountryPhone)
        <tr>
            <td>{{ $customerCountryPhone->countryPhone->name }}</td>
            <td>{{ $customerCountryPhone->phoneState->short_description }}</td>
            <td>+{{ $customerCountryPhone->countryPhone->code }}</td>
            <td>{{ $customerCountryPhone->customer->phoneSuffix }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div>
    {{ $customerCountryPhones->appends(request()->input())->links() }}
</div>
