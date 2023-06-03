@php
    use Illuminate\Support\Arr;
@endphp
<div class="w3-padding w3-tiny awb-item">
    <table class="w3-table w3-border-0 w3-tiny ">
        <tr>
            <td style="width: 10%;">
                <div style="padding-top: 18px">
                    <img src="{{ asset('assets/img/logo.jpeg')}}" height="77px">
                </div>
            </td>

            <td style="width: 25%" class="w3-display-container text-center w3-center">
                <br>
                <br>
                <span class="w3-padding w3-large">
                        {{ date('Y-m-d') }}
                </span>
            </td>

            <td style="width: 40%" class="w3-display-container text-center w3-center">
                <svg id="barcode{{ $resource->id }}" class="w3-block"></svg>
            </td>

            <td style="width: 25%;padding: 20px" class="w3-display-container w3-padding">
                <div id="qrcode{{ $resource->id }}" class="w3-block"></div>
            </td>
        </tr>
    </table>

    <div class="w3-padding">
        <table class="w3-table w3-bordered w3-border-black custom-table">
            <tr>
                <th class="w3-indigo w3-center" colspan="2">Shipper Name</th>
                <th class="w3-indigo w3-center" colspan="2">Contact Name</th>
            </tr>
            <tr>
                <td class="w3-display-container" colspan="2">
                    {{ $resource?->company?->name }}
                </td>

                <td class="w3-display-container" colspan="2">
                    {!! Arr::get($resource->receiver_data,'name') !!}
                </td>
            </tr>
            <tr>
                <td class="w3-display-container">
                    <b class="w3-left">
                        Origin
                    </b>

                    <span class="w3-right">
                        {{ $resource->branch?->city?->title }}
                    </span>
                </td>
                <td class="w3-display-container">
                    <b class="w3-left">
                        Province
                    </b>

                    <span class="w3-right">
                        {{ $resource->branch?->area?->title }}
                    </span>
                </td>
                <td class="w3-display-container">
                    <b class="w3-left">
                        Destination
                    </b>

                    <span class="w3-right">
                       {!! Arr::get($resource->receiver_data,'city') !!}
                    </span>
                </td>
                <td class="w3-display-container">
                    <b class="w3-left">
                        Province
                    </b>

                    <span class="w3-right">
                       {!! Arr::get($resource->receiver_data,'area') !!}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Contact Name
                    </b>

                    <span class="w3-right">
                        {{ $resource->branch?->name }}
                    </span>
                </td>

                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Company
                    </b>

                    <span class="w3-right">
                         {!! Arr::get($resource->receiver_data,'receiving_company') !!}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Address
                    </b>

                    <span class="w3-right">
                        {{ $resource->branch?->address }}
                    </span>
                </td>

                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Address
                    </b>

                    <span class="w3-right">
                        {!! \Illuminate\Support\Str::limit(Arr::get($resource->receiver_data,'address'),40) !!}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Tel
                    </b>

                    <span class="w3-right">
                        {{ $resource->branch?->phone }}
                    </span>
                </td>

                <td class="w3-display-container" colspan="2">
                    <b class="w3-left">
                        Tel
                    </b>

                    <span class="w3-right">
                        {!! Arr::get($resource->receiver_data,'phone1') !!}
                    </span>
                </td>
            </tr>


        </table>
        <table class="w3-table custom-table">
            <tr>
                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">
                        Receiver Name
                    </b>

                    <span class="w3-right">

                    </span>
                </td>


                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">
                        Title
                    </b>

                    <span class="w3-right">
                        {!! Arr::get($resource->receiver_data,'phone1') !!}
                    </span>
                </td>

                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">
                        Ref
                    </b>

                    <span class="w3-right">
                        {{ $resource->receiver_referance }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">]
                            Receiver Branch
                    </b>

                    <span class="w3-right">
                         {!! Arr::get($resource->receiver_data,'receiver_branch') !!}

                    </span>
                </td>

                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">
                        Service Type
                    </b>

                    <span class="w3-right">
                        {{ $resource->service_type }}
                    </span>
                </td>

                <td class="w3-display-container" style="width: 33.33%">
                    <b class="w3-left">
                        Department
                    </b>

                    <span class="w3-right">
                        {{ $resource->department?->name }}
                    </span>
                </td>
            </tr>

            <tr>

                <td class="w3-display-container" colspan="3">
                    <b class="w3-left">
                        note1
                    </b>

                    <span class="w3-right">
                        {{ $resource->additionalInfo->custom_field1 }}
                    </span>
                </td>
            </tr>

            <tr>

                <td class="w3-display-container" colspan="3">
                    <b class="w3-left">
                        note2
                    </b>

                    <span class="w3-right">
                        {{ $resource->additionalInfo->custom_field2 }}
                    </span>
                </td>
            </tr>
        </table>


    </div>


    <script>
        JsBarcode("#barcode{{ $resource->id }}", "{{ $resource->code }}", {
            font: 'Arial',
            height: 57,
            fontSize: 18,
        });

        // new QRCode(document.getElementById("qrcode{{ $resource->id }}"), {
        //     text: "{{ $resource->code }}",
        //     width: 57,
        //     height: 57,
        // });

    </script>

</div>
