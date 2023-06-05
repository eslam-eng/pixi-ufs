@php
    use Illuminate\Support\Arr;
    use \Illuminate\Support\Str;
@endphp
<div class="w3-padding w3-tiny awb-item">
    <table class="w3-table w3-border-0 w3-tiny ">
        <tr>
            <td>
                <div>
                    <img src="{{ asset('assets/img/logo.jpeg')}}" height="95px">
                </div>
            </td>

            <td style="width: 40%" class="w3-display-container text-center w3-center">
                <svg id="barcode{{ $resource->id }}" class="w3-block"></svg>
            </td>

            <td style="width: 25%;padding: 20px" class="w3-display-container w3-padding">
                <div id="qrcode_{{ $resource->id }}" class="w3-block"></div>
            </td>
        </tr>
    </table>

    <div>
        <table class="w3-table w3-bordered w3-border-black custom-table">

            <tr class="w3-indigo">
                <th colspan="4" class="w3-center" style="font-size: 17px">Sender</th>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">Company : </b> <span class="w3-right">{{ $resource?->company?->name }}</span></td>
                <td colspan="2"><b class="w3-left">Branch : </b><span class="w3-right">{{ $resource?->branch?->name }}</span></td>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">Province : </b> <span class="w3-right"> {{ $resource->branch?->area?->title }}</span></td>
                <td colspan="2"><b class="w3-left">Department : </b><span class="w3-right">{{ $resource?->department?->name }}</span></td>
            </tr>

            <tr class="w3-indigo">
                <th colspan="4" class="w3-center" style="font-size: 17px">Receiver</th>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">Name : </b> <span class="w3-right"> {!! Arr::get($resource->receiver_data,'name') !!}</span></td>
                <td colspan="2"><b class="w3-left">Phone : </b><span class="w3-right">{!! Arr::get($resource->receiver_data,'phone1') . " | " . Arr::get($resource->receiver_data,'phone2') !!}</span></td>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">Company : </b> <span class="w3-right"> {!! Arr::get($resource->receiver_data,'receiving_company') !!}</span></td>
                <td colspan="2"><b class="w3-left">weight : </b><span class="w3-padding">{{$resource->weight}}</span> <b class="w3-left">pieces : </b><span class="w3-padding">{{$resource->pieces}}</span></td>
            </tr>

            <tr>
                <td colspan="4"><b class="w3-left">address : </b> <span class="w3-padding"> {{$resource->receiver_address}}</span></td>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">Ref : </b> <span class="w3-right"> {{ $resource->receiver_reference }}</span></td>
                <td colspan="2"><b class="w3-left">province : </b><span class="w3-right">{!! Arr::get($resource->receiver_data,'area') !!}</span></td>
            </tr>

            <tr>
                <td colspan="2"><b class="w3-left">note1 : </b> <span>  {{ Str::limit($resource->additionalInfo->custom_field1,45) }}</span></td>
                <td colspan="2"><b class="w3-left">note2 : </b><span> {{ Str::limit($resource->additionalInfo->custom_field2,45) }}</span></td>
            </tr>
        </table>
    </div>

    <script>
        JsBarcode("#barcode{{ $resource->id }}", "{{ $resource->code }}", {
            font: 'Arial',
            height: 57,
            fontSize: 18,
        });

        {{--var qrcode = new QRCode(document.getElementById("qrcode_{{ $resource->id }}"), {--}}
        {{--    text: "https://webisora.com",--}}
        {{--    width: 100,--}}
        {{--    height: 90,--}}
        {{--    colorDark : "#17191d",--}}
        {{--    colorLight : "#ffffff",--}}
        {{--    correctLevel : QRCode.CorrectLevel.H--}}
        {{--});--}}

    </script>

</div>
