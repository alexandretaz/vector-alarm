<section id="alarm-contract-section">
    @if(strcasecmp($display, 'list')===0 && isset($contracts))
        @include('contracts.list', ['contracts'=> $contracts])
    @elseif(strcasecmp($display, 'form')===0 && isset($contract))
        @include('contracts.form', ['contract'=> $contract])
    @endif

</section>